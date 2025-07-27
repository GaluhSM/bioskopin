<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\Studio;
use App\Models\Seat;
use Illuminate\Http\Request;

class StudiosController extends Controller
{
    public function index()
    {
        $studios = Studio::with('cinema')->withCount('seats')->latest()->paginate(10);
        return view('admin.studios.index', compact('studios'));
    }

    public function create()
    {
        $cinemas = Cinema::all();
        return view('admin.studios.create', compact('cinemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cinema_id' => 'required|exists:cinemas,id',
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1|max:200',
        ]);

        $studio = Studio::create($request->all());

        // Auto-generate seats
        $this->generateSeats($studio);

        return redirect()->route('admin.studios.index')
            ->with('success', 'Studio created successfully with seats.');
    }

    public function show(Studio $studio)
    {
        $studio->load(['cinema', 'seats' => function($query) {
            $query->orderBy('row')->orderBy('number');
        }]);
        return view('admin.studios.show', compact('studio'));
    }

    public function edit(Studio $studio)
    {
        $cinemas = Cinema::all();
        return view('admin.studios.edit', compact('studio', 'cinemas'));
    }

    public function update(Request $request, Studio $studio)
    {
        $request->validate([
            'cinema_id' => 'required|exists:cinemas,id',
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1|max:200',
        ]);

        $oldCapacity = $studio->capacity;
        $studio->update($request->all());

        // If capacity changed, regenerate seats
        if ($oldCapacity != $request->capacity) {
            $studio->seats()->delete();
            $this->generateSeats($studio);
        }

        return redirect()->route('admin.studios.index')
            ->with('success', 'Studio updated successfully.');
    }

    public function destroy(Studio $studio)
    {
        $studio->delete();

        return redirect()->route('admin.studios.index')
            ->with('success', 'Studio deleted successfully.');
    }

    private function generateSeats(Studio $studio)
    {
        $capacity = $studio->capacity;
        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
        $seatsPerRow = ceil($capacity / count($rows));
        $totalSeats = 0;

        foreach ($rows as $row) {
            if ($totalSeats >= $capacity) break;
            
            $seatsInThisRow = min($seatsPerRow, $capacity - $totalSeats);
            
            for ($i = 1; $i <= $seatsInThisRow; $i++) {
                Seat::create([
                    'studio_id' => $studio->id,
                    'row' => $row,
                    'number' => $i,
                ]);
                $totalSeats++;
            }
        }
    }
}
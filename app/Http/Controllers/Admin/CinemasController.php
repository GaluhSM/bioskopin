<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemasController extends Controller
{
    public function index()
    {
        $cinemas = Cinema::withCount('studios')->latest()->paginate(10);
        return view('admin.cinemas.index', compact('cinemas'));
    }

    public function create()
    {
        return view('admin.cinemas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Cinema::create($request->all());

        return redirect()->route('admin.cinemas.index')
            ->with('success', 'Cinema created successfully.');
    }

    public function show(Cinema $cinema)
    {
        $cinema->load('studios.seats');
        return view('admin.cinemas.show', compact('cinema'));
    }

    public function edit(Cinema $cinema)
    {
        return view('admin.cinemas.edit', compact('cinema'));
    }

    public function update(Request $request, Cinema $cinema)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $cinema->update($request->all());

        return redirect()->route('admin.cinemas.index')
            ->with('success', 'Cinema updated successfully.');
    }

    public function destroy(Cinema $cinema)
    {
        $cinema->delete();

        return redirect()->route('admin.cinemas.index')
            ->with('success', 'Cinema deleted successfully.');
    }
}
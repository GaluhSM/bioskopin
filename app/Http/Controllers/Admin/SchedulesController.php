<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Movie;
use App\Models\Studio;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SchedulesController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['movie', 'studio.cinema'])
            ->latest('start_time')
            ->paginate(15);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $movies = Movie::all();
        $studios = Studio::with('cinema')->get();
        return view('admin.schedules.create', compact('movies', 'studios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'studio_id' => 'required|exists:studios,id',
            'start_time' => 'required|date|after:now',
            'price' => 'required|integer|min:1000',
        ]);

        $movie = Movie::findOrFail($request->movie_id);
        $startTime = Carbon::parse($request->start_time);
        $endTime = $startTime->copy()->addMinutes($movie->duration_minutes + 30); // Add 30 min buffer

        // Check for conflicts
        $conflict = Schedule::where('studio_id', $request->studio_id)
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                      });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['start_time' => 'Schedule conflicts with existing schedule in this studio.']);
        }

        Schedule::create([
            'movie_id' => $request->movie_id,
            'studio_id' => $request->studio_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    public function show(Schedule $schedule)
    {
        $schedule->load(['movie', 'studio.cinema', 'bookings.seats']);
        return view('admin.schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $movies = Movie::all();
        $studios = Studio::with('cinema')->get();
        return view('admin.schedules.edit', compact('schedule', 'movies', 'studios'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'studio_id' => 'required|exists:studios,id',
            'start_time' => 'required|date',
            'price' => 'required|integer|min:1000',
        ]);

        $movie = Movie::findOrFail($request->movie_id);
        $startTime = Carbon::parse($request->start_time);
        $endTime = $startTime->copy()->addMinutes($movie->duration_minutes + 30);

        // Check for conflicts (excluding current schedule)
        $conflict = Schedule::where('studio_id', $request->studio_id)
            ->where('id', '!=', $schedule->id)
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                      });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['start_time' => 'Schedule conflicts with existing schedule in this studio.']);
        }

        $schedule->update([
            'movie_id' => $request->movie_id,
            'studio_id' => $request->studio_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        // Check if there are bookings
        if ($schedule->bookings()->count() > 0) {
            return back()->withErrors(['error' => 'Cannot delete schedule with existing bookings.']);
        }

        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }
}
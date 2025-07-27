<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        $schedules = Schedule::with(['studio.cinema'])
                           ->where('movie_id', $id)
                           ->where('start_time', '>=', now())
                           ->orderBy('start_time')
                           ->get();
        
        return view('movie.show', compact('movie', 'schedules'));
    }
}
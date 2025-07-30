<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->paginate(10);
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration_minutes' => 'required|integer|min:1',
            'release_date' => 'required|date',
            'audience_rating' => 'required|string|max:10',
            'producer' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'is_trending' => 'boolean',
            'rating' => 'nullable|numeric|min:0|max:10',
        ]);

        $data = $request->all();
        $data['is_trending'] = $request->boolean('is_trending');

        if ($request->hasFile('poster')) {
            $data['poster_url'] = $request->file('poster')->store('posters', 'public');
        }

        Movie::create($data);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie created successfully.');
    }

    public function show(Movie $movie)
    {
        return view('admin.movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration_minutes' => 'required|integer|min:1',
            'release_date' => 'required|date',
            'audience_rating' => 'required|string|max:10',
            'producer' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'is_trending' => 'boolean',
            'rating' => 'nullable|numeric|min:0|max:10',
        ]);

        $data = $request->all();
        $data['is_trending'] = $request->boolean('is_trending');

        if ($request->hasFile('poster')) {
            // Delete old poster
            if ($movie->poster_url) {
                Storage::disk('public')->delete($movie->poster_url);
            }
            $data['poster_url'] = $request->file('poster')->store('posters', 'public');
        }

        if ($request->has('remove_poster')) {
            if ($movie->poster_url) {
                Storage::disk('public')->delete($movie->poster_url);
            }
            $data['poster_url'] = null;
        }

        $movie->update($data);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        // Delete poster file
        if ($movie->poster_url) {
            Storage::disk('public')->delete($movie->poster_url);
        }

        $movie->delete();

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie deleted successfully.');
    }
}
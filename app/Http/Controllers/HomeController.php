<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $trendingMovies = Movie::where('is_trending', true)->take(10)->get();
        $nowShowingMovies = Movie::whereDate('release_date', '<=', now())->take(10)->get();
        $topRatedMovies = Movie::whereNotNull('rating')->orderBy('rating', 'desc')->take(10)->get();
        
        return view('home', compact('trendingMovies', 'nowShowingMovies', 'topRatedMovies'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $movies = Movie::where('title', 'like', '%' . $query . '%')
                      ->orWhere('synopsis', 'like', '%' . $query . '%')
                      ->paginate(12);
        
        return view('search', compact('movies', 'query'));
    }
}
<?php

namespace App\View\Components\Movie;

use Illuminate\View\Component;

class Poster extends Component
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function render()
    {
        return view('components.movie.poster');
    }
}
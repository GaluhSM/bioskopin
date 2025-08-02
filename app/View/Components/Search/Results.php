<?php

namespace App\View\Components\Search;

use Illuminate\View\Component;

class Results extends Component
{
    public $movies;
    public $query;

    public function __construct($movies, $query)
    {
        $this->movies = $movies;
        $this->query = $query;
    }

    public function render()
    {
        return view('components.search.results');
    }
}
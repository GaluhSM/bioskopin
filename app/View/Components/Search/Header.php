<?php

namespace App\View\Components\Search;

use Illuminate\View\Component;

class Header extends Component
{
    public $query;
    public $totalMovies;

    public function __construct($query, $totalMovies)
    {
        $this->query = $query;
        $this->totalMovies = $totalMovies;
    }

    public function render()
    {
        return view('components.search.header');
    }
}
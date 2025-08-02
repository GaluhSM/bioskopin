<?php

namespace App\View\Components\Search;

use Illuminate\View\Component;

class Form extends Component
{
    public $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function render()
    {
        return view('components.search.form');
    }
}
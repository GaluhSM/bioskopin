<?php

namespace App\View\Components\Movie;

use Illuminate\View\Component;

class NoSchedules extends Component
{
    public function render()
    {
        return view('components.movie.no-schedules');
    }
}
<?php

namespace App\View\Components\Movie;

use Illuminate\View\Component;

class SchedulesSection extends Component
{
    public $schedules;

    public function __construct($schedules)
    {
        $this->schedules = $schedules;
    }

    public function render()
    {
        return view('components.movie.schedules-section');
    }
}
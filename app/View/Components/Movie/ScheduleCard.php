<?php

namespace App\View\Components\Movie;

use Illuminate\View\Component;

class ScheduleCard extends Component
{
    public $schedule;

    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

    public function render()
    {
        return view('components.movie.schedule-card');
    }
}
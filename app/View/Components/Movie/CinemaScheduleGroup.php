<?php

namespace App\View\Components\Movie;

use Illuminate\View\Component;

class CinemaScheduleGroup extends Component
{
    public $cinemaName;
    public $schedules;

    public function __construct($cinemaName, $schedules)
    {
        $this->cinemaName = $cinemaName;
        $this->schedules = $schedules;
    }

    public function render()
    {
        return view('components.movie.cinema-schedule-group');
    }
}
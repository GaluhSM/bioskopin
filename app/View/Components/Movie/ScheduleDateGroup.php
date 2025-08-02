<?php

namespace App\View\Components\Movie;

use Illuminate\View\Component;

class ScheduleDateGroup extends Component
{
    public $date;
    public $schedules;

    public function __construct($date, $schedules)
    {
        $this->date = $date;
        $this->schedules = $schedules;
    }

    public function render()
    {
        return view('components.movie.schedule-date-group');
    }
}
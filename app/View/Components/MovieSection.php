<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MovieSection extends Component
{
    public $movies;
    public $title;
    public $icon;
    public $iconColor;
    public $bgColor;

    public function __construct($movies, $title, $icon, $iconColor, $bgColor = 'gray-900')
    {
        $this->movies = $movies;
        $this->title = $title;
        $this->icon = $icon;
        $this->iconColor = $iconColor;
        $this->bgColor = $bgColor;
    }

    public function render()
    {
        return view('components.movie-section');
    }
}
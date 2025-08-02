<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Head extends Component
{
    public $title;
    public $styles;

    public function __construct($title = null, $styles = null)
    {
        $this->title = $title;
        $this->styles = $styles;
    }

    public function render()
    {
        return view('components.layout.head');
    }
}
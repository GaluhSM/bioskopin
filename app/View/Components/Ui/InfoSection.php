<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class InfoSection extends Component
{
    public $title;
    public $border;

    public function __construct($title, $border = true)
    {
        $this->title = $title;
        $this->border = $border;
    }

    public function render()
    {
        return view('components.ui.info-section');
    }
}
<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class ActionCard extends Component
{
    public $title;
    public $headerIcon;
    public $headerIconColor;

    public function __construct($title, $headerIcon, $headerIconColor)
    {
        $this->title = $title;
        $this->headerIcon = $headerIcon;
        $this->headerIconColor = $headerIconColor;
    }

    public function render()
    {
        return view('components.admin.action-card');
    }
}
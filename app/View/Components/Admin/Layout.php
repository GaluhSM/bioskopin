<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Layout extends Component
{
    public $title;
    public $pageTitle;

    public function __construct($title = null, $pageTitle = null)
    {
        $this->title = $title;
        $this->pageTitle = $pageTitle;
    }

    public function render()
    {
        return view('components.admin.layout');
    }
}
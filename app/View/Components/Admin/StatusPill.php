<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class StatusPill extends Component
{
    public $status;
    public $label;

    public function __construct($status, $label = null)
    {
        $this->status = $status;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.admin.status-pill');
    }
}
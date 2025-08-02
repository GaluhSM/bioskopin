<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class MetricCard extends Component
{
    public $icon;
    public $value;
    public $label;
    public $accentColor;
    public $iconBg;

    public function __construct($icon, $value, $label, $accentColor, $iconBg)
    {
        $this->icon = $icon;
        $this->value = $value;
        $this->label = $label;
        $this->accentColor = $accentColor;
        $this->iconBg = $iconBg;
    }

    public function render()
    {
        return view('components.admin.metric-card');
    }
}
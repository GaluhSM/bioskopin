<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Button extends Component
{
    public $variant;
    public $size;
    public $fullWidth;
    public $disabled;
    public $icon;
    public $tag;
    public $type;
    public $href;

    public function __construct(
        $variant = 'primary',
        $size = 'md',
        $fullWidth = false,
        $disabled = false,
        $icon = null,
        $tag = 'button',
        $type = null,
        $href = null
    ) {
        $this->variant = $variant;
        $this->size = $size;
        $this->fullWidth = $fullWidth;
        $this->disabled = $disabled;
        $this->icon = $icon;
        $this->tag = $tag;
        $this->type = $type;
        $this->href = $href;
    }

    public function render()
    {
        return view('components.ui.button');
    }
}
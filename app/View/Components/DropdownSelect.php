<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownSelect extends Component
{
    public $model;
    public $options;
    public $type = 'bordered';
    public $alltext;

    public function __construct($model, $options, $alltext, $type=null)
    {
        $this->model = $model;
        $this->options = $options;
        $this->alltext = $alltext;
        $this->type = $type ?? 'bordered';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown-select');
    }
}

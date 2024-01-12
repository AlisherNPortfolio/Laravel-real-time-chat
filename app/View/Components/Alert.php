<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public string|null $message = null;

    public string|null $type = null;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        if ($this->message = session('success')) {
            $this->type = 'success';
        } elseif ($this->message = session('error')) {
            $this->type = 'error';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}

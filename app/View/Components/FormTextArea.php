<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormTextArea extends Component
{
    public function __construct(
        public string $name,
        public string $label,
        public ?string $value = null,
        public ?string $placeholder = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-text-area');
    }
}

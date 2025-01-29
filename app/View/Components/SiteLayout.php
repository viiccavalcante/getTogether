<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SiteLayout extends Component
{
    public $title;
    public $include_alpine;

    public function __construct(?string $title = null, ?bool $noalpine = false)
    {
        $this->title = ucfirst($title);
        $this->include_alpine = ! $noalpine;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.site.layout');
    }

}

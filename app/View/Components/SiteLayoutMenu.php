<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SiteLayoutMenu extends Component
{
    public array $menu = [];
    public function __construct()
    {
        $this->menu = [
            'My Events' => route('user.events.index'),
        ];
   }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.site.menu');
    }
}

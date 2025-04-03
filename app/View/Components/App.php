<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public string|array|null $keywords = null,
        public ?string $ogImage = null,
        public ?string $ogUrl = null
    ) {}

    public function render(): View|Closure|string
    {
        return view('layout.app');
    }
}

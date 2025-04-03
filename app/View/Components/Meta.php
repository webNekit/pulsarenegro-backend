<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Meta extends Component
{
    public string $title;
    public string $description;
    public array $keywords;
    public string $ogImage;
    public string $ogUrl;

    public function __construct(
        ?string $title = null,
        ?string $description = null,
        string|array|null $keywords = null,
        ?string $ogImage = null,
        ?string $ogUrl = null
    ) {
        $this->title = $this->filterTitle($title);
        $this->description = $description ?? 'Описание по умолчанию';
        $this->keywords = $this->parseKeywords($keywords);
        $this->ogImage = $ogImage ?? asset('assets/img/default-og-image.jpg');
        $this->ogUrl = $ogUrl ?? url()->current();
    }

    protected function filterTitle(?string $title): string
    {
        return $title ?: config('app.name');
    }

    protected function parseKeywords(string|array|null $keywords): array
    {
        if ($keywords === null) {
            return [];
        }

        if (is_array($keywords)) {
            return $keywords;
        }

        $decoded = json_decode($keywords, true);
        return is_array($decoded) ? $decoded : [$keywords];
    }

    public function render(): View|Closure|string
    {
        return view('components.meta');
    }
}

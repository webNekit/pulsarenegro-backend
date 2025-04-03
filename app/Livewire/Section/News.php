<?php

namespace App\Livewire\Section;

use App\Models\News as ModelsNews;
use Livewire\Component;

class News extends Component
{
    public function getNewsPropery()
    {
        $news = ModelsNews::orderByDesc('created_at')
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->where('is_active', true)
            ->get();
        return $news;
    }
    public function render()
    {
        return view('livewire.section.news', [
            'news' => $this->getNewsPropery(),
        ]);
    }
}

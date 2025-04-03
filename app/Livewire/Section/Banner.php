<?php

namespace App\Livewire\Section;

use App\Models\News;
use Livewire\Component;

class Banner extends Component
{

    public function getNewsProperty()
    {
        return News::orderByDesc('created_at')
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->where('is_active', true)
            ->where('is_banner', true)
            ->get();
    }

    public function render()
    {
        return view('livewire.section.banner', [
            'news' => $this->getNewsProperty(),
        ]);
    }
}

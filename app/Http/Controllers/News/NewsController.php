<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news::index', [
            'title' => 'Новости',
            'meta_description' => 'Полезные новости',
        ]);
    }

    public function show($id)
    {
        $newsPost = News::findOrFail($id);
        $newsRecommendations = News::where('id', '!=', $newsPost->id)
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->inRandomOrder()->limit(4)->get();
        return view('news::show', [
            'title' => $newsPost->meta_title ?? $newsPost->title,
            'newsRecommendations' => $newsRecommendations,
            'post' => $newsPost,
        ]);
    }
}

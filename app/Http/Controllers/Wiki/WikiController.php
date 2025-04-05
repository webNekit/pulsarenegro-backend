<?php

namespace App\Http\Controllers\Wiki;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use App\Models\WikiCategory;
use App\Models\WikiPost;
use Illuminate\Http\Request;

class WikiController extends Controller
{
    public function index()
    {
        $seo = SeoMeta::where('page', 'knowledge_base')->first();
        $wikis = WikiCategory::where('is_active', true)->orderByDesc('created_at')->get();
        return view('wiki::index', [
            'title' => $company->title ?? 'База знаний',
            'meta_description' => $seo->meta_description ?? 'Описание страницы',
            'meta_keywords' => $seo->meta_keywords ?? 'Ключевые слова страницы',
            'wikis' => $wikis
        ]);
    }

    public function show($id)
    {
        $post = WikiPost::findOrFail($id);
        return view('wiki::show', [
            'title' => $post->title,
            'post' => $post,
        ]);
    }

    public function search(Request $request)
    {
        $posts = WikiPost::latest()
            ->whereLike('title', "%{$request->search}%")
            ->where('is_active', true)
            ->get();
        return view('wiki::search', [
            'title' => 'Результаты поиска',
            'search' => $request->search,
            'posts' => $posts
        ]);
    }
}

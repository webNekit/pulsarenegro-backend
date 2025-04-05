<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $seo = SeoMeta::where('page', 'home')->first();
        return view('main::index', [
            'title' => $seo->meta_title ?? 'Главная страница',
            'meta_description' => $seo->meta_description ?? 'Описание главной страницы',
            'meta_keywords' => $seo->meta_keywords ?? 'Ключевые слова главной страницы'
        ]);
    }
}

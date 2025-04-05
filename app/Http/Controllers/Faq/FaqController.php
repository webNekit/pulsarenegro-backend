<?php

namespace App\Http\Controllers\Faq;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $seo = SeoMeta::where('page', 'faq')->first();
        return view('faq::index', [
            'title' => $company->title ?? 'Часто задаваемые вопросы',
            'meta_description' => $seo->meta_description ?? 'Описание страницы',
            'meta_keywords' => $seo->meta_keywords ?? 'Ключевые слова страницы',
        ]);
    }
}

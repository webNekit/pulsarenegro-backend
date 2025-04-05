<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        $seo = SeoMeta::where('page', 'calculator')->first();
        return view('calculator::index', [
            'title' => $company->title ?? 'Калькулятор доходности',
            'meta_description' => $seo->meta_description ?? 'Описание страницы',
            'meta_keywords' => $seo->meta_keywords ?? 'Ключевые слова страницы',
        ]);
    }
}

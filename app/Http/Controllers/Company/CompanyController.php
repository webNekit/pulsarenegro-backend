<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SeoMeta;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::find(1);
        $seo = SeoMeta::where('page', 'about')->first();
        return view('company::index', [
            'title' => $company->title ?? 'О компании',
            'meta_description' => $seo->meta_description ?? 'Описание страницы',
            'meta_keywords' => $seo->meta_keywords ?? 'Ключевые слова страницы',
            'contents' => $company->content,
        ]);
    }
}

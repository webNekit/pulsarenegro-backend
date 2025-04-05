<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $table = 'seo_metas';
    protected $guarded = [];
    protected $casts = [
        'meta_keywords' => 'array'
    ];
    public const PAGES = [
        'home' => 'Главная страница',
        'about' => 'О компании',
        'knowledge_base' => 'База знаний',
        'faq' => 'Вопрос-ответ',
        'calculator' => 'Калькулятор'
    ];

    public function getPageNameAttribute(): string
    {
        return self::PAGES[$this->page] ?? $this->page;
    }
}

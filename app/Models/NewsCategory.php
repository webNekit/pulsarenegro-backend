<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = 'news_categories';

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function news()
    {
        return $this->hasMany(News::class, 'news_category_id');
    }
}

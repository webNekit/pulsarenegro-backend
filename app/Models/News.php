<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'is_banner' => 'boolean',
        'meta_keywords' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }
}

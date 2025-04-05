<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WikiPost extends Model
{
    protected $table = "wiki_posts";

    protected $guarded = [];

    protected $casts = ['is_active' => 'boolean'];

    public function category()
    {
        return $this->belongsTo(WikiCategory::class, 'wiki_category_id');
    }
}

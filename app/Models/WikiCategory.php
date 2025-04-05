<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WikiCategory extends Model
{
    protected $table = "wiki_categories";

    protected $guarded = [];

    protected $casts = ['is_active' => 'boolean'];

    public function posts()
    {
        return $this->hasMany(WikiPost::class, 'wiki_category_id');
    }
}

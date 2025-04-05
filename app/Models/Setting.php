<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];
    protected $casts = [
        'phones' => 'array',
        'emails' => 'array'
    ];

    public static function getSettings(): self
    {
        return self::firstOrCreate(['id' => 1], [
            'name' => 'Название сайта',
            'description' => 'Описание сайта',
            'phones' => [],
            'emails' => []
        ]);
    }
}

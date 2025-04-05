<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $guarded = [];
    protected $casts = [
        'content' => 'array'
    ];
    public static function getCompany(): self
    {
        return self::firstOrCreate(['id' => 1]);
    }
}

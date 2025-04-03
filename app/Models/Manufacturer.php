<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = 'manufacturers';
    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
    ];
}

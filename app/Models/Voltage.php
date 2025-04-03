<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voltage extends Model
{
    protected $table = 'voltages';
    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
    ];
}

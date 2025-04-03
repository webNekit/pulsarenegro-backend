<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Execution extends Model
{
    protected $table = 'executions';
    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
    ];
}

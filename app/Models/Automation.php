<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Automation extends Model
{
    protected $table = "automations";

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

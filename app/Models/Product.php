<?php

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'is_banner' => 'boolean',
        'price_rub' => 'decimal:0',
        'price_usd' => 'decimal:0',
        'image' => 'array',
        'engine_volume' => 'decimal:0',
        'ng_consumption_50' => 'decimal:2',
        'ng_consumption_100' => 'decimal:2',
        'ng_pressure' => 'decimal:0',
        'equipment' => 'array',
        'weight' => 'decimal:0'
    ];

    public function getPriceAttribute()
    {
        return $this->price_usd;
    }

    public function getPriceRubAttribute()
    {
        return app(CurrencyService::class)->convertUsdToRub($this->price_usd);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class, 'fuel_id');
    }

    public function voltage()
    {
        return $this->belongsTo(Voltage::class, 'voltage_id');
    }

    public function execution()
    {
        return $this->belongsTo(Execution::class, 'execution_id');
    }

    public function automation()
    {
        return $this->belongsTo(Automation::class, 'automation_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}

<?php

namespace App\Services;

use App\Models\Fuel;

class CatalogService
{
    public function getCatalog()
    {
        return Fuel::where('is_active', true)->orderBydesc('created_at')->get();
    }
}

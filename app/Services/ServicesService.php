<?php

namespace App\Services;

use App\Models\Service;

class ServicesService
{
    public function getServices()
    {
        return Service::where('is_active', true)
            ->orderByDesc('created_at')
            ->get();
    }
}

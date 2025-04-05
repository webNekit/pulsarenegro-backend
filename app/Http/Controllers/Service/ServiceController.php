<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('service::show', [
            'title' => $service->name,
            'service' => $service
        ]);
    }
}

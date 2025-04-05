<?php

namespace App\Services;

use App\Models\Setting;

class SettingsService
{
    public static function get()
    {
        return Setting::getSettings();
    }
}

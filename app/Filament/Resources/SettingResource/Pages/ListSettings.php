<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Resources\Pages\Page;
use Illuminate\Http\RedirectResponse;

class ListSettings extends Page
{
    protected static string $resource = SettingResource::class;

    protected static string $view = 'filament.resources.setting-resource.pages.list-settings';

    public function mount(): RedirectResponse
    {
        $setting = \App\Models\Setting::first();

        if ($setting) {
            return response()->redirectTo(SettingResource::getUrl('edit', ['record' => $setting->id]));
        }

        return response()->redirectTo(SettingResource::getUrl('create'));
    }
}

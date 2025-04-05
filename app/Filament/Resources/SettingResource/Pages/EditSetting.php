<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    public function mount(int|string|null $record = null): void
    {
        // Если record не передан (при переходе на /admin/settings)
        if ($record === null) {
            $settings = Setting::getSettings();
            $this->record = $settings;
            $this->fillForm();
            return;
        }

        // Стандартное поведение (при переходе на /admin/settings/1/edit)
        parent::mount($record);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}

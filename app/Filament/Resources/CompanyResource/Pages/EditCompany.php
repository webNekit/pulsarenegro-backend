<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Models\Company;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    public function mount(int|string|null $record = null): void
    {
        // Если record не передан (при переходе на /admin/settings)
        if ($record === null) {
            $settings = Company::getCompany();
            $this->record = $settings;
            $this->fillForm();
            return;
        }

        // Стандартное поведение (при переходе на /admin/settings/1/edit)
        parent::mount($record);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

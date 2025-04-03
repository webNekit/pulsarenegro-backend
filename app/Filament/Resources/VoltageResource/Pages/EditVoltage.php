<?php

namespace App\Filament\Resources\VoltageResource\Pages;

use App\Filament\Resources\VoltageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVoltage extends EditRecord
{
    protected static string $resource = VoltageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

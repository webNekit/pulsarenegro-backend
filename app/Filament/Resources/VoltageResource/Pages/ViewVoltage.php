<?php

namespace App\Filament\Resources\VoltageResource\Pages;

use App\Filament\Resources\VoltageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVoltage extends ViewRecord
{
    protected static string $resource = VoltageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

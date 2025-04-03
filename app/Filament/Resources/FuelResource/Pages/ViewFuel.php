<?php

namespace App\Filament\Resources\FuelResource\Pages;

use App\Filament\Resources\FuelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFuel extends ViewRecord
{
    protected static string $resource = FuelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

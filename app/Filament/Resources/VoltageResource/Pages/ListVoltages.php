<?php

namespace App\Filament\Resources\VoltageResource\Pages;

use App\Filament\Resources\VoltageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVoltages extends ListRecords
{
    protected static string $resource = VoltageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

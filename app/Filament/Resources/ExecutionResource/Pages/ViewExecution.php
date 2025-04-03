<?php

namespace App\Filament\Resources\ExecutionResource\Pages;

use App\Filament\Resources\ExecutionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewExecution extends ViewRecord
{
    protected static string $resource = ExecutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

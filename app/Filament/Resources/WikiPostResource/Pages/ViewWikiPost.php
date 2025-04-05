<?php

namespace App\Filament\Resources\WikiPostResource\Pages;

use App\Filament\Resources\WikiPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWikiPost extends ViewRecord
{
    protected static string $resource = WikiPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

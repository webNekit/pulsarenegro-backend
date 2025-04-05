<?php

namespace App\Filament\Resources\WikiCategoryResource\Pages;

use App\Filament\Resources\WikiCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWikiCategory extends ViewRecord
{
    protected static string $resource = WikiCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

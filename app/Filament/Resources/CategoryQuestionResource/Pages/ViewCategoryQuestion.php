<?php

namespace App\Filament\Resources\CategoryQuestionResource\Pages;

use App\Filament\Resources\CategoryQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCategoryQuestion extends ViewRecord
{
    protected static string $resource = CategoryQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

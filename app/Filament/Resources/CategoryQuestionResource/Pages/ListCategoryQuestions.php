<?php

namespace App\Filament\Resources\CategoryQuestionResource\Pages;

use App\Filament\Resources\CategoryQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryQuestions extends ListRecords
{
    protected static string $resource = CategoryQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\CategoryQuestionResource\Pages;

use App\Filament\Resources\CategoryQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryQuestion extends EditRecord
{
    protected static string $resource = CategoryQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

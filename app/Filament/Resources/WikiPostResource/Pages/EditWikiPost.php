<?php

namespace App\Filament\Resources\WikiPostResource\Pages;

use App\Filament\Resources\WikiPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWikiPost extends EditRecord
{
    protected static string $resource = WikiPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

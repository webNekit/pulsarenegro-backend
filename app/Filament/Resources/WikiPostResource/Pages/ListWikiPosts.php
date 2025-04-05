<?php

namespace App\Filament\Resources\WikiPostResource\Pages;

use App\Filament\Resources\WikiPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWikiPosts extends ListRecords
{
    protected static string $resource = WikiPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

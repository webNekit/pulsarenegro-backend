<?php

namespace App\Filament\Resources\WikiPostResource\Pages;

use App\Filament\Resources\WikiPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWikiPost extends CreateRecord
{
    protected static string $resource = WikiPostResource::class;
}

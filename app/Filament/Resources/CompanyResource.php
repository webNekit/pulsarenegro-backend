<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Администрирование';
    protected static ?string $navigationLabel = 'О компании';
    protected static ?string $modelLabel = 'настройки';
    protected static ?string $pluralModelLabel = 'настройки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('О компании')->schema([
                    Repeater::make('content')->label('Контент')->schema([
                        TextInput::make('title')->label('Заголовок'),
                        RichEditor::make('description')->label('Контент'),
                    ])->minItems(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getNavigationUrl(): string
    {
        return self::getUrl(); // Будет вести на маршрут '/'
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'edit' => Pages\EditCompany::route('/{record}/edit'),
            'index' => Pages\EditCompany::route('/'), // Добавляем этот маршрут
        ];
    }
}

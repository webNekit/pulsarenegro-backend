<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WikiCategoryResource\Pages;
use App\Filament\Resources\WikiCategoryResource\RelationManagers;
use App\Models\WikiCategory;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WikiCategoryResource extends Resource
{
    protected static ?string $model = WikiCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'База знаний';

    protected static ?string $navigationParentItem = "Записи";

    protected static ?string $navigationLabel = "Категории";

    protected static ?string $modelLabel = "категория";

    protected static ?string $pluralModelLabel = "категории";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основная информация')->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Название категории')
                        ->required(),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Отображать на сайте')
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название категории')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Отображать на сайте')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListWikiCategories::route('/'),
            'create' => Pages\CreateWikiCategory::route('/create'),
            'view' => Pages\ViewWikiCategory::route('/{record}'),
            'edit' => Pages\EditWikiCategory::route('/{record}/edit'),
        ];
    }
}

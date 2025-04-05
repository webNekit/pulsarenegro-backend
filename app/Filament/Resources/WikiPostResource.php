<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WikiPostResource\Pages;
use App\Filament\Resources\WikiPostResource\RelationManagers;
use App\Models\WikiCategory;
use App\Models\WikiPost;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WikiPostResource extends Resource
{
    protected static ?string $model = WikiPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';

    protected static ?string $navigationGroup = 'База знаний';

    protected static ?string $navigationLabel = "Записи";

    protected static ?string $modelLabel = "запись";

    protected static ?string $pluralModelLabel = "запись";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основная информация')->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Заголовок записи')
                        ->required(),
                    Forms\Components\RichEditor::make('content')
                        ->label('Контент записи')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('document')
                        ->directory('wiki')
                        ->label('Инструкция')
                        ->columnSpanFull(),
                ])->columnSpan(2),
                Section::make('')->schema([
                    Forms\Components\Select::make('wiki_category_id')
                        ->label('Категория')
                        ->searchable()
                        ->options(WikiCategory::where('is_active', true)->pluck('name', 'id'))
                        ->required(),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Отображать на сайте')
                        ->required(),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Категория')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Отображать на сайте')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
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
            'index' => Pages\ListWikiPosts::route('/'),
            'create' => Pages\CreateWikiPost::route('/create'),
            'view' => Pages\ViewWikiPost::route('/{record}'),
            'edit' => Pages\EditWikiPost::route('/{record}/edit'),
        ];
    }
}

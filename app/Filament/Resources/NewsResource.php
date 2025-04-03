<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use App\Models\NewsCategory;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Новости';

    protected static ?string $modelLabel = 'Новость';

    protected static ?string $pluralModelLabel = 'Новости';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('')->tabs([
                    Tabs\tab::make('Основное')->schema([
                        Forms\Components\Select::make('news_category_id')
                            ->options(NewsCategory::where('is_active', true)->pluck('name', 'id'))
                            ->searchable()
                            ->label('Категория новостей')
                            ->required(),
                        Forms\Components\TextInput::make('title')
                            ->label('Заголовок')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label('Краткое описание')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('content')
                            ->label('Контент новости')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->directory('news')
                            ->label('Изображение')
                            ->image()
                            ->columnSpanFull(),
                    ])->columns(2),
                    Tabs\tab::make('Meta-теги')->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Заголовок'),
                        Forms\Components\TagsInput::make('meta_keywords')
                            ->label('Ключевые слова'),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Описание'),
                    ]),
                ])->columnSpan(2),
                Section::make('')->schema([
                    Forms\Components\Toggle::make('is_active')
                        ->label('Отображать на сайте'),
                    Forms\Components\Toggle::make('is_popular')
                        ->label('Отображать в разделе "Популярное"'),
                    Forms\Components\Toggle::make('is_banner')
                        ->label('Отображать в баннере'),
                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Категория')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'view' => Pages\ViewNews::route('/{record}'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}

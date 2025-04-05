<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeoMetaResource\Pages;
use App\Filament\Resources\SeoMetaResource\RelationManagers;
use App\Models\SeoMeta;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SeoMetaResource extends Resource
{
    protected static ?string $model = SeoMeta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Администрирование';
    protected static ?string $navigationLabel = 'Seo';
    protected static ?string $navigationParentItem = "Настройки";
    protected static ?string $modelLabel = 'seo';
    protected static ?string $pluralModelLabel = 'seo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основная информация')->schema([
                    Forms\Components\TextInput::make('meta_title')
                        ->label('Meta-заголовок')
                        ->maxLength(60),
                    Forms\Components\Textarea::make('meta_description')
                        ->label('Meta-описание')
                        ->maxLength(160),
                    Forms\Components\TagsInput::make('meta_keywords')
                        ->label('Meta-ключевые слова')
                        ->placeholder('Добавьте ключевые слова')
                ])->columnSpan(2),
                Section::make('Посадочная страница')->schema([
                    Forms\Components\Select::make('page')
                        ->label('Страница')
                        ->options(SeoMeta::PAGES)
                        ->required()
                        ->unique(
                            table: SeoMeta::class,
                            column: 'page',
                            ignoreRecord: true
                        )
                        ->validationMessages([
                            'unique' => 'Метатеги для этой страницы уже существуют',
                        ])
                        ->disabled(fn($context) => $context === 'edit')
                        ->helperText(
                            fn($context) =>
                            $context === 'edit'
                                ? 'Изменение страницы запрещено'
                                : 'Выберите страницу для SEO'
                        )
                        ->native(false),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page_name')
                    ->label('Страница'),
                Tables\Columns\TextColumn::make('meta_title')
                    ->label('Заголовок')
                    ->limit(30),
                Tables\Columns\TextColumn::make('meta_description')
                    ->label('Описание')
                    ->limit(30),
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
            'index' => Pages\ListSeoMetas::route('/'),
            'create' => Pages\CreateSeoMeta::route('/create'),
            'view' => Pages\ViewSeoMeta::route('/{record}'),
            'edit' => Pages\EditSeoMeta::route('/{record}/edit'),
        ];
    }
}

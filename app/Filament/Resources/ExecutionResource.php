<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExecutionResource\Pages;
use App\Filament\Resources\ExecutionResource\RelationManagers;
use App\Models\Execution;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExecutionResource extends Resource
{
    protected static ?string $model = Execution::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = "Склад";

    protected static ?string $navigationParentItem = "Генераторы";

    protected static ?string $modelLabel = "тип исполнения";

    protected static ?string $pluralModelLabel = "типы исполнения";

    protected static ?string $navigationLabel = "Типы исполнения";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основная информация')->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Название')
                        ->required(),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Активная запись')
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активная запись')
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
            'index' => Pages\ListExecutions::route('/'),
            'create' => Pages\CreateExecution::route('/create'),
            'view' => Pages\ViewExecution::route('/{record}'),
            'edit' => Pages\EditExecution::route('/{record}/edit'),
        ];
    }
}

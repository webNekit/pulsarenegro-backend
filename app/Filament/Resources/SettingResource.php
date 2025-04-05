<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Администрирование';
    protected static ?string $navigationLabel = 'Настройки';
    protected static ?string $modelLabel = 'настройки';
    protected static ?string $pluralModelLabel = 'настройки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название сайта')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label('Описание сайта')
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('phones')
                    ->label('Телефоны')
                    ->schema([
                        Forms\Components\TextInput::make('number')
                            ->tel()
                            ->prefix('+7')
                            ->label('Номер телефона')
                    ])->columnSpanFull(),
                Forms\Components\Repeater::make('emails')
                    ->label('Email адреса')
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->label('Email')
                            ->email()
                    ])->columnSpanFull(),
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

    public static function getPages(): array
    {
        return [
            'edit' => Pages\EditSetting::route('/{record}/edit'),
            'index' => Pages\EditSetting::route('/'), // Добавляем этот маршрут
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Imports\ProductImport;
use App\Models\Automation;
use App\Models\Brand;
use App\Models\Execution;
use App\Models\Fuel;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Voltage;
use App\Models\Welding;
use App\Services\CurrencyService;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationGroup = "Склад";

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = "Генераторы";

    protected static ?string $modelLabel = "генератор";

    protected static ?string $pluralModelLabel = "генераторы";

    public static function form(Form $form): Form
    {
        $currencyService = app(CurrencyService::class);

        return $form
            ->schema([
                Tabs::make('Tabs')->tabs([
                    Tabs\Tab::make('Основная информация')->schema([
                        Section::make('')->schema([
                            TextInput::make('title')
                                ->label('Название генератора')
                                ->required(),
                            Forms\Components\TextInput::make('model')
                                ->label('Модель генератора')
                                ->required(),
                            RichEditor::make('description')
                                ->label('Описание')
                                ->columnSpanFull(),
                        ])->columns(2),
                        Section::make('Характеристики')->schema([
                            Select::make('manufacturer_id')
                                ->label('Производитель')
                                ->searchable()
                                ->options(Manufacturer::where('is_active', 1)->pluck('name', 'id')),
                            Select::make('brand_id')
                                ->label('Бренд')
                                ->searchable()
                                ->options(Brand::where('is_active', 1)->pluck('name', 'id')),
                            Select::make('fuel_id')
                                ->label('Топливо')
                                ->searchable()
                                ->options(Fuel::where('is_active', 1)->pluck('name', 'id')),
                            Select::make('voltage_id')
                                ->label('Напряжение')
                                ->searchable()
                                ->options(Voltage::where('is_active', 1)->pluck('name', 'id')),
                            Select::make('execution_id')
                                ->label('Исполнение')
                                ->searchable()
                                ->options(Execution::where('is_active', 1)->pluck('name', 'id')),
                            Select::make('automation_id')
                                ->label('Автоматизация')
                                ->searchable()
                                ->options(Automation::where('is_active', 1)->pluck('name', 'id')),
                        ])->columns(2),
                        Section::make('Дополнительная информация')->schema([
                            Forms\Components\TextInput::make('start_type')
                                ->label('Тип запуска')
                                ->required(),
                            Forms\Components\TextInput::make('engine_type')
                                ->label('Тип двигателя')
                                ->required(),
                            Forms\Components\TextInput::make('engine_model')
                                ->label('Модель двигателя')
                                ->required(),
                            Forms\Components\TextInput::make('engine_volume')
                                ->label('Объем двигателя')
                                ->suffix('Л')
                                ->numeric()
                                ->required(),
                            Forms\Components\TextInput::make('cooling_type')
                                ->label('Тип охлаждения')
                                ->required(),
                            Forms\Components\TextInput::make('nominal_power')
                                ->label('Номинальная мощность')
                                ->required(),
                            Forms\Components\TextInput::make('engine_rpm')
                                ->label('Обороты двигателя')
                                ->suffix('об/мин')
                                ->numeric()
                                ->required(),
                            Forms\Components\TextInput::make('ng_consumption_50')
                                ->label('Расход NG при 50% мощности')
                                ->suffix('m3/час')
                                ->required()
                                ->numeric(),
                            Forms\Components\TextInput::make('ng_consumption_100')
                                ->label('Расход NG при 100% мощности')
                                ->suffix('m3/час')
                                ->required()
                                ->numeric(),
                            Forms\Components\TextInput::make('ng_pressure')
                                ->label('Давление газа')
                                ->suffix('кПа')
                                ->required(),
                            Forms\Components\TextInput::make('phase_type')
                                ->label('Тип фазности')
                                ->required(),
                            Forms\Components\TextInput::make('generator_type')
                                ->label('Тип электрогенератора')
                                ->required(),
                            Forms\Components\TextInput::make('dimensions')
                                ->label('Габариты')
                                ->suffix('мм')
                                ->required(),
                            Forms\Components\TextInput::make('weight')
                                ->label('Масса')
                                ->suffix('кг')
                                ->required()
                                ->numeric(),
                            Forms\Components\TextInput::make('country')
                                ->label('Страна производства')
                                ->required(),
                        ])->columns(2),
                        Section::make('')->schema([
                            Repeater::make('equipment')->schema([
                                TextInput::make('name')->label('Название')->minLength(2),
                            ])->label('Комплектация'),
                        ]),
                        Section::make('')->schema([
                            FileUpload::make('image')
                                ->label('Изображение')
                                ->image()
                                ->multiple()
                                ->directory('products'),
                        ]),
                    ]),
                    Tabs\Tab::make('Meta-теги')->schema([
                        Section::make('')->schema([
                            Forms\Components\TextInput::make('meta_title')
                                ->label('Заголовок'),
                            Forms\Components\TagsInput::make('meta_keywords')
                                ->label('Ключевые слова'),
                            Forms\Components\Textarea::make('meta_description')
                                ->label('Описание'),
                        ]),
                    ]),
                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make('Стоимость')->schema([
                        TextInput::make('price_usd')
                            ->label('Цена (USD)')
                            ->required()
                            ->numeric()
                            ->step(0.01)
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) use ($currencyService) {
                                $rubPrice = $currencyService->convertUsdToRub((float)$state);
                                $set('price_rub', $rubPrice);
                            }),

                        TextInput::make('price_rub')
                            ->label('Цена (RUB)')
                            ->numeric()
                            ->readOnly()
                            ->dehydrated()
                            ->suffix('RUB')
                            ->default(function () use ($currencyService) {
                                $usdPrice = request()->input('price_usd') ?? 0;
                                return $currencyService->convertUsdToRub((float)$usdPrice);
                            }),
                    ]),
                    Section::make('Статусы')->schema([
                        Toggle::make('is_active')
                            ->default(true)
                            ->label('Активный товар'),
                        Toggle::make('is_popular')
                            ->default(false)
                            ->label('Популярный товар'),
                        Toggle::make('is_banner')
                            ->default(false)
                            ->label('Отображать в баннере'),
                    ]),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('Импорт из Excel')
                    ->form([
                        FileUpload::make('file')
                            ->label('Выберите файл')
                            ->disk('local') // Загружаем файл в локальное хранилище
                            ->directory('imports') // Каталог для сохранения
                            ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        if (!$data['file']) {
                            Notification::make()
                                ->title('Файл не загружен!')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Получаем абсолютный путь к файлу через Storage
                        $filePath = Storage::disk('local')->path($data['file']);

                        // Проверяем, существует ли файл
                        if (!file_exists($filePath)) {
                            Notification::make()
                                ->title('Файл не найден!')
                                ->danger()
                                ->send();
                            return;
                        }

                        Excel::import(new ProductImport, $filePath);

                        Notification::make()
                            ->title('Импорт завершен!')
                            ->success()
                            ->send();
                    })
            ])
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_rub')
                    ->label('Цена (руб)')
                    ->numeric()
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Отображать на сайте'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('manufacturer_id')
                    ->label('Производители')
                    ->searchable()
                    ->options(Manufacturer::all()->pluck('name', 'id')),
                SelectFilter::make('fuel_id')
                    ->label('Топливо')
                    ->searchable()
                    ->options(Fuel::all()->pluck('name', 'id')),
                SelectFilter::make('voltage_id')
                    ->label('Напряжение')
                    ->searchable()
                    ->options(Voltage::all()->pluck('name', 'id')),
                SelectFilter::make('execution_id')
                    ->label('Исполнение')
                    ->searchable()
                    ->options(Execution::all()->pluck('name', 'id')),
                SelectFilter::make('automation_id')
                    ->label('Автоматизация')
                    ->searchable()
                    ->options(Automation::all()->pluck('name', 'id')),
                SelectFilter::make('brand_id')
                    ->label('Бренд')
                    ->searchable()
                    ->options(Brand::all()->pluck('name', 'id')),
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

    public static function importAction(): Action
    {
        return Action::make('import')
            ->label('Импорт из Excel')
            ->icon('heroicon-o-arrow-up-tray')
            ->form([
                Forms\Components\FileUpload::make('file')
                    ->label('Файл Excel')
                    ->required()
                    ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']),
            ])
            ->action(function (array $data) {
                Excel::import(new ProductImport, $data['file']->getRealPath());
            })
            ->successNotificationTitle('Импорт завершен');
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

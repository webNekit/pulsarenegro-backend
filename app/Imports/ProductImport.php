<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Логируем сырые данные для отладки
        \Log::info('Raw row data:', $row);

        // Проверяем обязательное поле "nazvanie" (было "Название")
        if (empty($row['nazvanie'])) {
            \Log::warning('Пропущена строка без названия');
            return null;
        }

        return new Product([
            'title'              => $row['nazvanie'], // "Название" → "nazvanie"
            'description'       => $row['opisanie'] ?? null, // "Описание" → "opisanie"
            'price_rub'         => $row['cena_v_rubliax'] ?? null, // "Цена в рублях" → "cena_v_rubliax"
            'price_usd'         => $row['cena_v_dollarax'] ?? null, // "Цена в долларах" → "cena_v_dollarax"
            'nominal_power'     => $row['nominalnaia_moshhnost_generatora'] ?? null, // "Номинальная мощность" → "nominalnaia_moshhnost_generatora"
            'model'             => $row['model_elektrostancii'] ?? null, // "Модель электростанции" → "model_elektrostancii"
            'start_type'        => $row['tip_zapuska'] ?? null, // "Тип запуска" → "tip_zapuska"
            'engine_type'       => $row['dvigatel'] ?? null, // "Двигатель" → "dvigatel"
            'engine_model'      => $row['model_dvigatelia'] ?? null, // "Модель двигателя" → "model_dvigatelia"
            'engine_volume'     => $row['obieem_dvigatelia'] ?? null, // "Объем двигателя" → "obieem_dvigatelia"
            'cooling_type'      => $row['oxlazdenie'] ?? null, // "Охлаждение" → "oxlazdenie"
            'engine_rpm'        => $row['oboroty_dvigatelia'] ?? null, // "Обороты двигателя" → "oboroty_dvigatelia"
            'ng_consumption_50' => $row['rasxod_ng_pri_50_moshhnosti'] ?? null, // "Расход NG при 50%" → "rasxod_ng_pri_50_moshhnosti"
            'ng_consumption_100' => $row['rasxod_ng_pri_100_moshhnosti'] ?? null, // "Расход NG при 100%" → "rasxod_ng_pri_100_moshhnosti"
            'ng_pressure'       => $row['davlenie_gaza_ng'] ?? null, // "Давление газа NG" → "davlenie_gaza_ng"
            'phase_type'        => $row['tip_faznosti'] ?? null, // "Тип фазности" → "tip_faznosti"
            'generator_type'    => $row['tip_elektrogeneratora'] ?? null, // "Тип генератора" → "tip_elektrogeneratora"
            'dimensions'        => $row['gabarity'] ?? null, // "Габариты" → "gabarity"
            'weight'            => $row['massa'] ?? null, // "Масса" → "massa"
            'country'           => $row['strana_proizvodstva'] ?? null, // "Страна производства" → "strana_proizvodstva"

            // Булевы поля (если в Excel "Да/Нет" или "1/0")
            'is_active'         => $this->convertToBoolean($row['pokazyvat_na_saite'] ?? true), // "Показывать на сайте" → "pokazyvat_na_saite"
            'is_popular'       => $this->convertToBoolean($row['populiarnyi_tovar'] ?? false), // "Популярный товар" → "populiarnyi_tovar"
            'is_banner'        => $this->convertToBoolean($row['pokazyvat_v_bannere'] ?? false), // "Показывать в баннере" → "pokazyvat_v_bannere"
        ]);
    }

    private function convertToBoolean($value): bool
    {
        return match (strtolower($value)) {
            'да', '1', 'yes', 'true' => true,
            default => false,
        };
    }
}

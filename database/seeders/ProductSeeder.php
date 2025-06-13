<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Удаляем старые данные
        DB::table('products')->truncate();

        // Вставляем два продукта
        DB::table('products')->insert([
            [
                'manufacturer_id' => 1,
                'fuel_id' => 1,
                'voltage_id' => 2,
                'execution_id' => 2,
                'automation_id' => 2,
                'brand_id' => 1,
                'title' => 'Дизельный генератор FG Wilson P55-1',
                'description' => 'Надежный дизельный генератор для промышленного использования',
                'price_rub' => 4700000,          // Стоимость установки для примера
                'price_usd' => 0,
                'model' => 'P55-1',
                'start_type' => 'Электростартер',
                'engine_type' => 'Дизельный',
                'engine_model' => '4BTAA3.9-G2',
                'engine_volume' => 3.9,
                'cooling_type' => 'Жидкостное',
                'engine_rpm' => 1500,
                'ng_consumption_50' => null,    // Можно оставить null, чтобы взять ng_consumption_100
                'ng_consumption_100' => 63,     // Расход газа в м3/ч при 100% нагрузке (из твоего примера)
                'ng_pressure' => null,
                'nominal_power' => 200,          // Номинальная мощность кВт
                'phase_type' => '3-фазный',
                'generator_type' => 'Синхронный',
                'dimensions' => '2000x800x1200 мм',
                'weight' => 850,
                'country' => 'Великобритания',
                'is_active' => true,
                'is_popular' => true,
                'is_banner' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // Продукт с пустыми значениями, для проверки подстановки дефолтов
                'manufacturer_id' => 2,
                'fuel_id' => 3,
                'voltage_id' => 2,
                'execution_id' => 1,
                'automation_id' => 3,
                'brand_id' => 2,
                'title' => 'Тестовый генератор без данных',
                'description' => 'Тестовый продукт с пустыми расходами и мощностью',
                'price_rub' => 1000000,
                'price_usd' => 0,
                'model' => 'Test-01',
                'start_type' => 'Ручной',
                'engine_type' => 'Газовый',
                'engine_model' => 'TestModel',
                'engine_volume' => null,
                'cooling_type' => null,
                'engine_rpm' => null,
                'ng_consumption_50' => null,
                'ng_consumption_100' => null,
                'ng_pressure' => null,
                'nominal_power' => null,
                'phase_type' => null,
                'generator_type' => null,
                'dimensions' => null,
                'weight' => null,
                'country' => null,
                'is_active' => true,
                'is_popular' => false,
                'is_banner' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

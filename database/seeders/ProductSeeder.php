<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = [
            [
                'manufacturer_id' => 1,
                'fuel_id' => 1,
                'voltage_id' => 2,
                'execution_id' => 2,
                'automation_id' => 2,
                'brand_id' => 1,
                'title' => 'Дизельный генератор FG Wilson P55-1',
                'description' => 'Надежный дизельный генератор для промышленного использования',
                'price_rub' => 1250000,
                'price_usd' => 15000,
                'model' => 'P55-1',
                'start_type' => 'Электростартер',
                'engine_type' => 'Дизельный',
                'engine_model' => '4BTAA3.9-G2',
                'engine_volume' => 3.9,
                'cooling_type' => 'Жидкостное',
                'engine_rpm' => 1500,
                'ng_consumption_50' => null,
                'ng_consumption_100' => null,
                'ng_pressure' => null,
                'phase_type' => '3-фазный',
                'generator_type' => 'Синхронный',
                'dimensions' => '2000x800x1200 мм',
                'weight' => 850,
                'country' => 'Великобритания',
                'is_active' => true,
                'is_popular' => true,
                'is_banner' => false
            ],
            [
                'manufacturer_id' => 2,
                'fuel_id' => 3,
                'voltage_id' => 2,
                'execution_id' => 1,
                'automation_id' => 3,
                'brand_id' => 2,
                'title' => 'Газовый генератор Cummins QSK60G',
                'description' => 'Мощный газовый генератор для непрерывной работы',
                'price_rub' => 8500000,
                'price_usd' => 100000,
                'model' => 'QSK60G',
                'start_type' => 'Пневматический',
                'engine_type' => 'Газовый',
                'engine_model' => 'QSK60G',
                'engine_volume' => 60.0,
                'cooling_type' => 'Жидкостное',
                'engine_rpm' => 1500,
                'ng_consumption_50' => 45.8,
                'ng_consumption_100' => 82.5,
                'ng_pressure' => 2.75,
                'phase_type' => '3-фазный',
                'generator_type' => 'Синхронный',
                'dimensions' => '3500x1500x2000 мм',
                'weight' => 4500,
                'country' => 'США',
                'is_active' => true,
                'is_popular' => false,
                'is_banner' => true
            ],
            [
                'manufacturer_id' => 3,
                'fuel_id' => 2,
                'voltage_id' => 1,
                'execution_id' => 3,
                'automation_id' => 1,
                'brand_id' => 3,
                'title' => 'Бензиновый генератор SDMO Perform 3000',
                'description' => 'Компактный бензиновый генератор для бытового использования',
                'price_rub' => 45000,
                'price_usd' => 600,
                'model' => 'Perform 3000',
                'start_type' => 'Ручной',
                'engine_type' => 'Бензиновый',
                'engine_model' => 'Honda GX160',
                'engine_volume' => 0.16,
                'cooling_type' => 'Воздушное',
                'engine_rpm' => 3000,
                'ng_consumption_50' => null,
                'ng_consumption_100' => null,
                'ng_pressure' => null,
                'phase_type' => '1-фазный',
                'generator_type' => 'Асинхронный',
                'dimensions' => '600x450x500 мм',
                'weight' => 45,
                'country' => 'Франция',
                'is_active' => true,
                'is_popular' => true,
                'is_banner' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

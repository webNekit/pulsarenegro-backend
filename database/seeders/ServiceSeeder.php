<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $services = [
            [
                'name' => 'Продажа генераторов',
                'description' => 'Широкий ассортимент генераторов различной мощности от ведущих производителей',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Аренда генераторов',
                'description' => 'Временное использование генераторов для строительных площадок и мероприятий',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ремонт и обслуживание',
                'description' => 'Профессиональный ремонт и плановое техническое обслуживание генераторов',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Пусконаладочные работы',
                'description' => 'Профессиональный монтаж и настройка генераторного оборудования',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Доставка и установка',
                'description' => 'Транспортировка оборудования к месту эксплуатации и профессиональный монтаж',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Консультации специалистов',
                'description' => 'Помощь в подборе оптимального генератора для ваших нужд',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('services')->insert($services);
    }
}

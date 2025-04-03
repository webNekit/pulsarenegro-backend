<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Новые поступления генераторов', 'is_active' => true],
            ['name' => 'Техническое обслуживание', 'is_active' => true],
            ['name' => 'Советы по эксплуатации', 'is_active' => true],
            ['name' => 'Промоакции', 'is_active' => true],
            ['name' => 'Отзывы клиентов', 'is_active' => false], // Неактивная категория для примера
        ];

        foreach ($categories as $category) {
            NewsCategory::firstOrCreate(
                ['name' => $category['name']],
                ['is_active' => $category['is_active']]
            );
        }
    }
}

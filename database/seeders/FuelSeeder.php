<?php

namespace Database\Seeders;

use App\Models\Fuel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $fuels = [
            ['name' => 'Дизель', 'is_active' => true],
            ['name' => 'Бензин', 'is_active' => true],
            ['name' => 'Газ (NG)', 'is_active' => true],
            ['name' => 'Газ (LPG)', 'is_active' => true],
            ['name' => 'Гибрид', 'is_active' => false],
        ];

        foreach ($fuels as $fuel) {
            Fuel::firstOrCreate(
                ['name' => $fuel['name']],
                ['is_active' => $fuel['is_active']]
            );
        }
    }
}

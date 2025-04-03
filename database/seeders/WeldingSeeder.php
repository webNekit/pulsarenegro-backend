<?php

namespace Database\Seeders;

use App\Models\Welding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeldingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $weldings = [
            ['name' => 'Да', 'is_active' => true],
            ['name' => 'Нет', 'is_active' => true],
            ['name' => 'Опционально', 'is_active' => true],
        ];

        foreach ($weldings as $welding) {
            Welding::firstOrCreate(
                ['name' => $welding['name']],
                ['is_active' => $welding['is_active']]
            );
        }
    }
}

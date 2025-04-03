<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $manufacturers = [
            ['name' => 'FG Wilson', 'is_active' => true],
            ['name' => 'Cummins', 'is_active' => true],
            ['name' => 'SDMO', 'is_active' => true],
            ['name' => 'Generac', 'is_active' => true],
            ['name' => 'AKSA', 'is_active' => true],
        ];

        foreach ($manufacturers as $manufacturer) {
            Manufacturer::firstOrCreate(
                ['name' => $manufacturer['name']],
                ['is_active' => $manufacturer['is_active']]
            );
        }
    }
}

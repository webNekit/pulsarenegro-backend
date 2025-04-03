<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $brands = [
            ['name' => 'Cummins', 'is_active' => true],
            ['name' => 'Perkins', 'is_active' => true],
            ['name' => 'Volvo Penta', 'is_active' => true],
            ['name' => 'MTU', 'is_active' => true],
            ['name' => 'Lovol', 'is_active' => true],
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate(
                ['name' => $brand['name']],
                ['is_active' => $brand['is_active']]
            );
        }
    }
}

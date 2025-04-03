<?php

namespace Database\Seeders;

use App\Models\Voltage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoltageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $voltages = [
            ['name' => '220В', 'is_active' => true],
            ['name' => '380В', 'is_active' => true],
            ['name' => '400В', 'is_active' => true],
            ['name' => '480В', 'is_active' => true],
        ];

        foreach ($voltages as $voltage) {
            Voltage::firstOrCreate(
                ['name' => $voltage['name']],
                ['is_active' => $voltage['is_active']]
            );
        }
    }
}

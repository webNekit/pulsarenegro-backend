<?php

namespace Database\Seeders;

use App\Models\Automation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutomationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $automations = [
            ['name' => 'Ручной запуск', 'is_active' => true],
            ['name' => 'Автозапуск', 'is_active' => true],
            ['name' => 'ATS панель', 'is_active' => true],
            ['name' => 'Дистанционный', 'is_active' => true],
        ];

        foreach ($automations as $automation) {
            Automation::firstOrCreate(
                ['name' => $automation['name']],
                ['is_active' => $automation['is_active']]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Execution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExecutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $executions = [
            ['name' => 'Открытое', 'is_active' => true],
            ['name' => 'В кожухе', 'is_active' => true],
            ['name' => 'Контейнерное', 'is_active' => true],
            ['name' => 'Мобильное', 'is_active' => true],
        ];

        foreach ($executions as $execution) {
            Execution::firstOrCreate(
                ['name' => $execution['name']],
                ['is_active' => $execution['is_active']]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Название сайта',
                'description' => 'Описание сайта',
                'phones' => ['+7 (123) 456-78-90'],
                'emails' => ['admin@example.com'],
            ]
        );
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // NewsCategorySeeder::class,
            // NewsSeeder::class,
            AutomationSeeder::class,
            BrandSeeder::class,
            ExecutionSeeder::class,
            FuelSeeder::class,
            ManufacturerSeeder::class,
            VoltageSeeder::class,
            ProductSeeder::class
        ]);
    }
}

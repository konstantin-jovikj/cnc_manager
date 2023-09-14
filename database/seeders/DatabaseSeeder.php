<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ToolSeeder;
use Database\Seeders\ShapeSeeder;
use Database\Seeders\StationSeeder;
use Database\Seeders\PositionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ToolSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(StationSeeder::class);
        $this->call(ShapeSeeder::class);
    }
}

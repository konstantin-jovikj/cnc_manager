<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Station::insert([
            ['station' => 'A'],
            ['station' => 'B'],
            ['station' => 'C'],
            ['station' => 'D'],
            ['station' => 'E'],
            ['station' => 'F'],
            ['station' => 'G'],
            ['station' => 'H'],
            ['station' => 'J'],
            ['station' => 'K'],
            ['station' => '112 style - index'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Shape;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shape::insert([
            ['shape' => 'Round'],
            ['shape' => 'Rectangle'],
            ['shape' => 'Oval'],
            ['shape' => 'Square'],
            ['shape' => 'Single-D'],
            ['shape' => 'Double-D'],
            ['shape' => 'Quad-D'],
            ['shape' => 'Hexagon'],
            ['shape' => 'Octagon'],
            ['shape' => 'Diamond'],
            ['shape' => 'Triangle'],

        ]);
    }
}

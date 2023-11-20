<?php

namespace Database\Seeders;

use App\Models\LaundryLoad;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LaundryLoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LaundryLoad::factory()->create([
            'kilo' => '8',
            'price' => '160',
        ]);
    }
}

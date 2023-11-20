<?php

namespace Database\Seeders;

use App\Models\LaundryKilo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LaundryKiloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LaundryKilo::factory()->create([
            'type' => 'Bedding Items',
            'price' => '65',
        ]);

        LaundryKilo::factory()->create([
            'type' => 'Clothes',
            'price' => '65',
        ]);

        LaundryKilo::factory()->create([
            'type' => 'Household Items',
            'price' => '68',
        ]);
    }
}

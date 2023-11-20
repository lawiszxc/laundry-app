<?php

namespace Database\Seeders;

use App\Models\Detergent;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetergentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Detergent::factory()->create([
            'type' => 'Customer Provided',
            'price' => '0',
        ]);

        Detergent::factory()->create([
            'type' => 'Cala',
            'price' => '11',
        ]);

        Detergent::factory()->create([
            'type' => 'Cala w/ Downy',
            'price' => '13',
        ]);

        Detergent::factory()->create([
            'type' => 'Surf',
            'price' => '12',
        ]);

        Detergent::factory()->create([
            'type' => 'Surf w/ Downy',
            'price' => '14',
        ]);
    }
}

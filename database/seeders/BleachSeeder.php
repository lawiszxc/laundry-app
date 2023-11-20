<?php

namespace Database\Seeders;

use App\Models\Bleach;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BleachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bleach::factory()->create([
            'type' => 'N/A',
            'price' => '0',
        ]);

        Bleach::factory()->create([
            'type' => 'Customer Provided',
            'price' => '0',
        ]);

        Bleach::factory()->create([
            'type' => 'Zonrox',
            'price' => '13',
        ]);

        Bleach::factory()->create([
            'type' => 'Clorox',
            'price' => '12',
        ]);

    }
}

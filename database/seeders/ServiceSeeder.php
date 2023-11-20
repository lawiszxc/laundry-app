<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::factory()->create([
            'type' => 'Wash and Dry',
            'price' => '35',
        ]);

        Service::factory()->create([
            'type' => 'Wash, Dry and Fold',
            'price' => '53',
        ]);
    }
}

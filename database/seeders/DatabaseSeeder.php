<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\BarangaySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected $model = User::class;

    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'role' => 'ADMIN',
            'name' => 'ADMINISTRATOR',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123'),
            'phoneNum' => '09758469156',
            'barangayID' => '6',
        ]);

        User::factory()->create([
            'role' => 'USER',
            'name' => 'Ren Joy Sabio',
            'email' => 'joy@gmail.com',
            'password' => bcrypt('123123'),
            'phoneNum' => '09754565301',
            'barangayID' => '9',
            'status' => 'ACTIVE',
        ]);

        User::factory()->create([
            'role' => 'DRIVER',
            'name' => 'Neil Dagangon',
            'email' => 'neil@gmail.com',
            'password' => bcrypt('123123'),
            'phoneNum' => '09653273551',
            'barangayID' => '3',
        ]);

        $this->call(BleachSeeder::class);
        $this->call(DetergentSeeder::class);
        $this->call(LaundryKiloSeeder::class);
        $this->call(LaundryLoadSeeder::class);
        $this->call(ServiceSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Barangay;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangays = [
            'Bonbon',
            'Cugman',
            'Gusa',
            'Kauswagan',
            'Lapasan',
            'Macabalan',
            'Nazareth',
            'Patag',
            'Puntod',
            'Tablon',
            'Agusan',
            'Balulang',
            'Bayabas',
            'Carmen',
            'Consolacion',
            'Iponan',
            'Lumbia',
            'Macasandig',
            'Pigsag-an',
            'Puerto'
        ];

        foreach ($barangays as $barangay) {
            $price = rand(15, 30);

            Barangay::create([
                'barangay' => $barangay,
                'price' => $price,
            ]);
        }
    }
}

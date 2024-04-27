<?php

namespace Database\Seeders;

use App\Models\TourismCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourismCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TourismCategory::create([
            'id'    => 1,
            'name' => 'Alam',
        ]);

        TourismCategory::create([
            'id'    => 2,
            'name' => 'Budaya',
        ]);

        TourismCategory::create([
            'id'    => 3,
            'name' => 'Rohani',
        ]);

        TourismCategory::create([
            'id'    => 4,
            'name' => 'Transportasi',
        ]);

        TourismCategory::create([
            'id'    => 5,
            'name' => 'Agro',
        ]);

        TourismCategory::create([
            'id'    => 6,
            'name' => 'Edukasi',
        ]);
    }
}

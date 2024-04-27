<?php

namespace Database\Seeders;

use App\Models\HotelCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HotelCategory::create([
            'id'    => 1,
            'name' => 'Homestay',
        ]);

        HotelCategory::create([
            'id'    => 2,
            'name' => 'Villa',
        ]);

        HotelCategory::create([
            'id'    => 3,
            'name' => 'Hotel (Bintang 1)',
        ]);

        HotelCategory::create([
            'id'    => 4,
            'name' => 'Hotel (Bintang 2)',
        ]);
        
        HotelCategory::create([
            'id'    => 5,
            'name' => 'Hotel (Bintang 3)',
        ]);

        HotelCategory::create([
            'id'    => 6,
            'name' => 'Hotel (Bintang 4)',
        ]);

        HotelCategory::create([
            'id'    => 7,
            'name' => 'Hotel (Bintang 5)',
        ]);
    }
}

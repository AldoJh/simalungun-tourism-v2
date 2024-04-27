<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\FacilitySeeder;
use Database\Seeders\HotelCategorySeeder;
use Database\Seeders\TourismCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            FacilitySeeder::class,
            HotelCategorySeeder::class,
            TourismCategorySeeder::class,
        ]);
    }
}

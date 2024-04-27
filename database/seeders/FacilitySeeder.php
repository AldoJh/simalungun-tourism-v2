<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::create([
            'id'    => 1,
            'name' => 'Free WIFI',
        ]);

        Facility::create([
            'id'    => 2,
            'name' => 'Parkiran',
        ]);

        Facility::create([
            'id'    => 3,
            'name' => 'Toilet',
        ]);

        Facility::create([
            'id'    => 4,
            'name' => 'Musholla',
        ]);

        Facility::create([
            'id'    => 5,
            'name' => 'Kamar',
        ]);

        Facility::create([
            'id'    => 6,
            'name' => 'Banana Boat',
        ]);

        Facility::create([
            'id'    => 7,
            'name' => 'Spot Foto',
        ]);

        Facility::create([
            'id'    => 8,
            'name' => 'Kolam Renang',
        ]);

        Facility::create([
            'id'    => 9,
            'name' => 'Restoran',
        ]);

        Facility::create([
            'id'    => 10,
            'name' => 'Wahana',
        ]);

        Facility::create([
            'id'    => 21,
            'name' => 'Aula / Meeting Room',
        ]);

        Facility::create([
            'id'    => 12,
            'name' => 'Pondok / Joglo',
        ]);

        Facility::create([
            'id'    => 13,
            'name' => 'Billiard',
        ]);

        Facility::create([
            'id'    => 14,
            'name' => 'Warung Makan / Minum',
        ]);

        Facility::create([
            'id'    => 15,
            'name' => 'Shuttle',
        ]);

        Facility::create([
            'id'    => 16,
            'name' => 'Live Music / Bar',
        ]);

        Facility::create([
            'id'    => 17,
            'name' => 'Lift',
        ]);

        Facility::create([
            'id'    => 18,
            'name' => 'TV',
        ]);

        Facility::create([
            'id'    => 19,
            'name' => 'KM Ferry',
        ]);

        Facility::create([
            'id'    => 20,
            'name' => 'Water Heater',
        ]);
    }
}

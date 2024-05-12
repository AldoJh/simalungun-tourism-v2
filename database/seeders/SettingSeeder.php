<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'id' => 1,
            'site_name' => 'Simalungun Tourism',
            'description' => 'Simalungun Tourism adalah website promosi pariwisata Simalungun <br> dikelola oleh Dinas kebudayaan, pariwisata dan ekonomi kreatif Kabupaten Simalungun',
            'playstore' => '#',
            'email' => 'DISBUDPAREKRAFbudsimalungun24@gmail.com',
            'whatsapp' => '081263144637',
            'instagram' => 'https://www.instagram.com/DISBUDPAREKRAFbud_simalungun/',
            'facebook' => '#'
        ]);
    }
}

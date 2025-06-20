<?php

namespace Database\Seeders;

use App\Models\CommunityGroup;
use App\Models\CommunityGroups;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunityGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('community_groups')->insert([
            [
                'name' => 'Sugar Warriors',
                'description' => 'Menggambarkan semangat orang-orang yang "berperang" melawan diabetes setiap hari, dengan kontrol, edukasi, dan saling support.',
                'group_link' => 'https://chat.whatsapp.com/Ew6WDVRGt4H4MS60KhBwQG',
                'logo' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'The Invisible Fighters',
                'description' => 'Banyak penyakit autoimun tampak "tidak terlihat" dari luar, tapi perjuangannya nyata. Komunitas ini memberi tempat bagi para pejuang yang kadang tidak dipahami lingkungan sekitar.',
                'group_link' => 'https://chat.whatsapp.com/JFYX8IXzUpW7mCeUjCtnBm',
                'logo' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mind Haven',
                'description' => 'Tempat aman (haven) untuk pikiran yang lelah. Komunitas ini menjadi ruang suportif bagi semua yang sedang berjuang menjaga kesehatan mental.',
                'group_link' => 'https://chat.whatsapp.com/FZ0bZK5vQm62GEyZbw6Ksx',
                'logo' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Brave Cells',
                'description' => 'Menggambarkan sel-sel tubuh yang terus bertarung dan jiwa yang penuh keberanian. Juga punya nuansa ilmiah dan puitis.',
                'group_link' => 'https://chat.whatsapp.com/LpCV1ALahEK01Uj2fHmHqL',
                'logo' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Breathe Together',
                'description' => 'Mengajak orang-orang untuk bernapas bersama — secara harfiah dan simbolis. Menunjukkan bahwa kamu tidak sendirian dalam perjuangan ini.',
                'group_link' => 'https://chat.whatsapp.com/IdvW9VBCroYKwqWo267lKW',
                'logo' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);    }
}

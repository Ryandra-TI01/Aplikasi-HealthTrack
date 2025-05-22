<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class HealthTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Tekanan Darah', 'unit' => 'mmHg'],
            ['name' => 'Suhu Tubuh', 'unit' => '°C'],
            ['name' => 'Saturasi Oksigen', 'unit' => '%'],
            ['name' => 'Denyut Jantung', 'unit' => 'BPM'],
            ['name' => 'Berat Badan', 'unit' => 'kg'],
            ['name' => 'Tinggi Badan', 'unit' => 'cm'],
            ['name' => 'Gula Darah', 'unit' => 'mg/dL'],
        ];

        foreach ($data as $item) {
            DB::table('health_types')->insert([
                'name' => $item['name'],
                'unit' => $item['unit'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

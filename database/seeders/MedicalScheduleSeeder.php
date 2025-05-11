<?php

namespace Database\Seeders;

use App\Models\MedicalSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicalSchedule::factory(5)->create();
    }
}

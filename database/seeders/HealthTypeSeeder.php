<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HealthTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Drop and recreate the table
        Schema::disableForeignKeyConstraints();
        DB::table('health_types')->truncate();
        Schema::enableForeignKeyConstraints();

        // Seed data with value_type
        $data = [
            ['name' => 'Blood Pressure', 'unit' => 'mmHg', 'value_type' => 'decimal'],
            ['name' => 'Body Temperature', 'unit' => '°C', 'value_type' => 'decimal'],
            ['name' => 'Oxygen Saturation', 'unit' => '%', 'value_type' => 'decimal'],
            ['name' => 'Heart Rate', 'unit' => 'BPM', 'value_type' => 'decimal'],
            ['name' => 'Body Weight', 'unit' => 'kg', 'value_type' => 'decimal'],
            ['name' => 'Height', 'unit' => 'cm', 'value_type' => 'decimal'],
            ['name' => 'Blood Glucose', 'unit' => 'mg/dL', 'value_type' => 'decimal'],
            ['name' => 'Respiratory Rate', 'unit' => 'breaths/min', 'value_type' => 'decimal'],
            ['name' => 'Cholesterol', 'unit' => 'mg/dL', 'value_type' => 'decimal'],
            ['name' => 'Body Mass Index', 'unit' => 'BMI', 'value_type' => 'decimal'],
            ['name' => 'Waist Circumference', 'unit' => 'cm', 'value_type' => 'decimal'],
            ['name' => 'Vision Acuity', 'unit' => 'Snellen', 'value_type' => 'string'],
            ['name' => 'Hearing Level', 'unit' => 'dB', 'value_type' => 'decimal'],
            ['name' => 'Body Fat Percentage', 'unit' => '%', 'value_type' => 'decimal'],
            ['name' => 'Hydration Level', 'unit' => '%', 'value_type' => 'decimal'],
            ['name' => 'Health Diary', 'unit' => '-', 'value_type' => 'string'],
        ];

        foreach ($data as $item) {
            DB::table('health_types')->insert([
                'name' => $item['name'],
                'unit' => $item['unit'],
                'value_type' => $item['value_type'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\PdfReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PdfReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PdfReport::factory(5)->create();
    }
}

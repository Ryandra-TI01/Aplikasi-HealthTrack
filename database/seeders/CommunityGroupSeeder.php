<?php

namespace Database\Seeders;

use App\Models\CommunityGroup;
use App\Models\CommunityGroups;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunityGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommunityGroup::factory(3)->create();
    }
}

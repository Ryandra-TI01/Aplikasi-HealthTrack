<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([ 'name' => 'Admin User', 'email' => 'admin@gmail.com', ])->assignRole('admin');
        User::factory(50)->create()->each(function ($user) {
            $user->assignRole('user');
        });
        
    }
}

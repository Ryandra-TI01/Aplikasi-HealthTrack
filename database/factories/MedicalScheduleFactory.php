<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalSchedule>
 */
class MedicalScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['medicine', 'appointment']),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'reminder_time' => $this->faker->dateTimeBetween('+1 day', '+1 month'),
            'is_completed' => $this->faker->boolean(),
            'repeat_interval' => $this->faker->randomElement(['daily', 'weekly', 'monthly']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

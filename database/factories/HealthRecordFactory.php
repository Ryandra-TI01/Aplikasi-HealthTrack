<?php

namespace Database\Factories;

use App\Models\HealthType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HealthRecord>
 */
class HealthRecordFactory extends Factory
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
            'health_type_id' => HealthType::inRandomOrder()->first(),
            'recorded_at' => $this->faker->date(),
            'notes' => $this->faker->sentence(),
            'value' => $this->faker->randomFloat(2, 30, 120),
            'raw_value' => (string) $this->faker->randomFloat(2, 30, 120),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

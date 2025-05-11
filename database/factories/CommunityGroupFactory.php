<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommunityGroup>
 */
class CommunityGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'group_link' => $this->faker->url(),
            'logo' => 'https://picsum.photos/seed/' . fake()->uuid() . '/600/400',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

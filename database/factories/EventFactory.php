<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(5),
            'location' => fake()->sentence(8),
            'description' => fake()->realText(300),
            'event_date' => fake()->dateTimeBetween('now', '+6 months'),
            'created_by' => fake()->numberBetween(1,5),
        ];
    }
}

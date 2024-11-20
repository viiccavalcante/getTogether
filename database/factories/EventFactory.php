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
            'name' => fake()->sentence,
            'location' => fake()->sentence,
            'description' => fake()->realText(300),
            'event_date' => fake()->dateTime,
           // 'created_by' => fake()->numberBetween(1,10),
        ];
    }
}

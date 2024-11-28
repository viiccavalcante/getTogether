<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'can_edit' => fake()->boolean(),
            'event_id' => fake()->numberBetween(1,15),
            'user_id' =>  fake()->numberBetween(1,10),
        ];
    }
}

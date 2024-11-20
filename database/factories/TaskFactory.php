<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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
            'description' => fake()->realText(180),
            'status' => fake()->numberBetween(0,4),
            'expenses' => fake()->randomFloat(2, 5, 100),
           //'event_id' => //fake()->numberBetween(1,10),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Task;
use App\Models\Guest;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'vic',
            'email' => 'vic@xx.com',
            'password' => 'lalala',
        ]);

        User::factory(4)->create();

        Event::factory(15)->create();
        Task::factory(50)->create();
        Guest::factory(30)->create();

        foreach (Task::get() as $task) {
            $guests = Guest::inRandomOrder()->take(random_int(0, 4))->get();
            $task->guests()->attach($guests);
        }

    }
}

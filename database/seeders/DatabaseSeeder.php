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
            'name' => 'Victoria Cavalcante',
            'email' => 'vic@xx.com',
            'password' => 'lalala',
        ]);

        User::factory(10)->create();

        Event::factory(15)->create();
        Task::factory(50)->create();
        Guest::factory(30)->create();

        foreach (Task::get() as $task) {
            $guests = Guest::inRandomOrder()->take(random_int(0, 4))->get(); //takes from 0 to 4 guests to assign
            $task->guests()->attach($guests);
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Task;
use App\Models\Participant;
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

        foreach (Event::get() as $event) {
            $users = User::inRandomOrder()->take(random_int(0, 4))->get()->unique('id');
            $event->participants()->attach($users);
        }

        Task::factory(50)->create();
        //Participant::factory(30)->create();

        // foreach (Task::get() as $task) {
        //     $participants = Participant::inRandomOrder()->take(random_int(0, 4))->get();
        
        //     $participantIds = $participants->pluck('id')->toArray();
        //     \Log::info('Attaching participants: ', $participantIds);
        
        //     if (count($participantIds) > 0) {
        //         $task->participants()->attach($participantIds);
        //     }
        // }
        
    }
}

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
            'password' => bcrypt('lalala'), 
        ]);

        User::factory(10)->create();
        $events = Event::factory(15)->create();
        
        foreach ($events as $event) {
            $tasks = Task::factory(random_int(1, 3))->create([
                'event_id' => $event->id, 
            ]);

            
            $guests = Guest::factory(random_int(1, 5))->create([
                'event_id' => $event->id, 
            ]);

            Guest::factory()->create([
                'event_id' => $event->id, 
                'user_id' => $event->created_by
            ]);
    
            foreach ($tasks as $task) {
                $taskGuests = $guests->random(random_int(0, $guests->count()))->pluck('id');
                $task->guests()->attach($taskGuests);
            }
        }

    }
}

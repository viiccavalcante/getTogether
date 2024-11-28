<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Enums\TaskStatus;

class TaskController extends Controller
{
    public function create(int $id, Request $request)
    {
        $event = \App\Models\Event::findOrFail($id);
        $event->load('guests', 'creator');

        $eventGuests = User::getAllFromGuests($event->id)->get();
        $allEventUsers = $eventGuests->push($event->creator)->pluck('name', 'id')->toArray();

        return view('user.events.tasks.create', compact('event', 'allEventUsers'));
    }
    
    public function store(int $id, Request $request,)
    {
        $event = \App\Models\Event::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'max:300'],
            'expenses' => ['nullable', 'numeric', 'min:0.01'], 
        ]);

        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => TaskStatus::Assigned,
            'expenses' => $request->expenses,
            'event_id' => $event->id,
        ]);

        $task->guests()->attach($request->guests);

        session()->flash('success', 'Task [<span class="font-bold">'.$event->name.'</span>] created successfully');

        return redirect()->route('user.events.show', compact('event'));
    }

    public function destroy(string $taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->load('guests', 'event');
        //$event->authorized(auth()->user(), true);

        if($task->guests){
            $this->DeleteEventGuests($event->guests->pluck('id'));
        }

        $task->delete();
        session()->flash('success', 'Event [<span class="font-bold">'.$task->name.'</span>] deleted successfully');

        return redirect()->route('user.events.show', compact('task->event'));
    }
}

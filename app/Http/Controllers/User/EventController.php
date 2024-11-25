<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('created_by', auth()->user()->id)->paginate(20);

        return view('user.events.index', compact('events'));
    }


    public function create()
    {
        return view('user.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'location' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string'],
            'event_date' => ['required', 'date', 'after:today'],
            'guests' => ['nullable', 'array'],
        ]);

        $event = Event::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'created_by' => auth()->user()->id,
        ]);

        $event->guests()->sync($request->guests);

        session()->flash('success', 'Event [<span class="font-bold">'.$event->name.'</span>] created successfully');

        return redirect()->route('user.events.index');
    }

    public function show(int $event_id)
    {
        $event = Event::findOrFail($event_id);

        //$this->isAuthorized($event);

        return view('user.events.show', compact('event'));
    }

    public function edit(int $event_id)
    {
        $event = Event::findOrFail($event_id);

       // $this->isAuthorized($event);

        return view('user.events.edit', compact('event'));
    }

    public function update(Request $request, int $event_id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'location' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string'],
            'event_date' => ['required', 'date', 'after:today'],
            'guests' => ['nullable', 'array'],
        ]);

        $event = Event::find($event_id);

        //$this->isAuthorized($event);

        $event->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'event_date' => $request->event_date,
        ]);

        session()->flash('success', 'Event [<span class="font-bold">'.$event->name.'</span>] updated successfully');

        return redirect()->route('user.events.index');
    }

    public function destroy(int $event_id)
    {
        $event = Event::findOrFail($event_id);

       // $this->isCreator($event);

        $event->delete();

        session()->flash('success', 'Event [<span class="font-bold">'.$event->name.'</span>] deleted successfully');

        return redirect()->route('user.events.index');
    }

    private function isAuthorized(Event $event, bool $creator_only): void
    {
        // if($creator){

        // }
        if ($event->created_by != auth()->user()->id) {
            abort(401);
        }
    }
}

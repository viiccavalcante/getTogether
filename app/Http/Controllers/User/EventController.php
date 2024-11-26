<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('created_by', auth()->user()->id)
                         ->orderByDesc('event_date')
                         ->paginate(20);

        return view('user.events.index', compact('events'));
    }


    public function create()
    {
        $guests = User::getAllExcept(auth()->user()->id)
                        ->get()
                        ->pluck('name', 'id')
                        ->toArray();
        
        return view('user.events.create', compact('guests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'location' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string'],
            'event_date' => ['required', 'date', 'after_or_equal:today'],
            'guests' => ['nullable', 'array'],
        ]);

        $event = Event::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'created_by' => auth()->user()->id,
        ]);

        if($request->guests){
            $this->SaveEventGuests($request->guests, $event->id);
        }

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

        $guests = User::getAllExcept(auth()->user()->id)
                        ->get()
                        ->pluck('name', 'id')
                        ->toArray();
        $selectedGuests = $event->guests->pluck('user.id')->toArray();

        return view('user.events.edit', compact('event', 'guests', 'selectedGuests'));
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

        if($request->guests){
            //condicao p ver se mudou meso e n fazer isos tudo atoa
            $this->DeleteEventGuests($event->guests->pluck('id'));
            $this->SaveEventGuests($request->guests, $event->id);
        }
        

        session()->flash('success', 'Event [<span class="font-bold">'.$event->name.'</span>] updated successfully');

        return redirect()->route('user.events.index');
    }

    public function destroy(int $event_id)
    {
        $event = Event::findOrFail($event_id);

       // $this->isCreator($event);
        if($event->guests){
            $this->DeleteEventGuests($event->guests->pluck('id'));
        }
    
        $event->delete();

        session()->flash('success', 'Event [<span class="font-bold">'.$event->name.'</span>] deleted successfully');

        return redirect()->route('user.events.index');
    }

    private function isAuthorized(Event $event, bool $creator_only): void
    {
         //if($creator_only){

        // }
        if ($event->created_by != auth()->user()->id) {
            abort(401);
        }
    }

    private function SaveEventGuests(array $newGuests,int $eventId):void 
    {
        foreach ($newGuests as $userId) {
            Guest::create([
                'event_id' => $eventId,
                'user_id' => $userId,
            ]);
        }
    }

    private function DeleteEventGuests($previousGuests):void 
    {
        Guest::whereIn('id', $previousGuests)->delete();
    }

}

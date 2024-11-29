<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('created_by', auth()->user()->id)
                        ->where('event_date', '>=', today())
                        ->orWhereHas('participants', function ($query) {
                            $query->where('user_id', auth()->user()->id);
                        })
                        ->orderBy('event_date', 'asc')
                        ->paginate(10);

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
            'description' => ['required', 'string', 'max:500'],
            'event_date' => ['required', 'date', 'after_or_equal:today'],
            'participants' => ['nullable', 'array'],
        ]);

        $event = Event::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'created_by' => auth()->user()->id,
        ]);

        if($request->participants){
            $this->SaveEventParticipants($request->guests, $event->id, auth()->user()->id);
        }

        session()->flash('success', 'Event [<span class="font-bold">'.$event->name.'</span>] created successfully');

        return redirect()->route('user.events.index');
    }

    public function show(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->authorized(auth()->user(), false);
        
        return view('user.events.show', compact('event'));
    }

    public function edit(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->authorized(auth()->user(), true);

        $guests = User::getAllExcept(auth()->user()->id)
                        ->get()
                        ->pluck('name', 'id')
                        ->toArray();
        $selectedGuests = $event->participants->pluck('user.id')->toArray();

        return view('user.events.edit', compact('event', 'guests', 'selectedGuests'));
    }

    public function update(Request $request, int $eventId)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'location' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'event_date' => ['required', 'date', 'after_or_equal:today'],
            'participants' => ['nullable', 'array'],
        ]);

        $event = Event::find($eventId);
        $event->authorized(auth()->user(), true);

        $event->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'event_date' => $request->event_date,
        ]);

        if($request->participants){
            //******condicao p ver se mudou meso e n fazer isos tudo atoa
            $this->DeleteEventParticipants($event->participants->pluck('id'));
            $this->SaveEventParticipants($request->participants, $event->id, $event->created_by);
        }
        

        session()->flash('success', 'Event [<span class="font-bold">'.$event->name.'</span>] updated successfully');

        return redirect()->route('user.events.index');
    }

    public function destroy(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->authorized(auth()->user(), true);

        if($event->participants){
            $this->DeleteEventParticipants($event->participants->pluck('id'));
        }

        $event->tasks()->delete();//achoq ue precisa deletar da tabela de task tb
        $event->delete();

        session()->flash('success', 'Event [<span class="font-bold">'.$event->name.'</span>] deleted successfully');

        return redirect()->route('user.events.index');
    }

    private function SaveEventParticipants(array $newParticipants,int $eventId, string $creator_id):void 
    {
        array_push($newParticipants, $creator_id);
        foreach ($newParticipants as $userId) {
            Participant::create([
                'event_id' => $eventId,
                'user_id' => $userId,
            ]);
        }
    }

    private function DeleteEventParticipants($previousParticipants):void 
    {
        
        Participant::whereIn('id', $previousParticipants)->delete();
    }

}

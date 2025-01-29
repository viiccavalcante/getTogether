<?php

namespace App\Http\Controllers\User;

use App\Enums\TaskStatus;
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
                        ->where('event_date', '>=', today())
                        ->orWhereHas('guests', function ($query) {
                            $query->where('user_id', auth()->user()->id);
                        })
                        ->orderBy('event_date', 'asc')
                        ->paginate(10);
        $user = auth()->user();

        return view('user.events.index', compact('events', 'user'));
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
            'guests' => ['nullable', 'array'],
        ]);

        $event = Event::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'created_by' => auth()->user()->id,
        ]);

       
        $this->SaveEventGuests($request->guests, $event->id, auth()->user()->id);

        session()->flash('success', 'Event [<span class="font-bold">'.$event->name.'</span>] created successfully');

        return redirect()->route('user.events.index');
    }

    public function show(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->authorized(auth()->user(), false);

        $user = auth()->user();
        //$tasks = Task::findOrFail($event_id);
        
        return view('user.events.show', compact('event', 'user'));
    }

    public function edit(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->authorized(auth()->user(), true);

        $guests = User::getAllExcept(auth()->user()->id)
                        ->get()
                        ->pluck('name', 'id')
                        ->toArray();
        $selectedGuests = $event->guests->pluck('user.id')->toArray();

        return view('user.events.edit', compact('event', 'guests', 'selectedGuests'));
    }

    public function update(Request $request, int $eventId)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'location' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'event_date' => ['required', 'date', 'after_or_equal:today'],
           // 'guests' => ['nullable', 'array'],
        ]);

        $event = Event::find($eventId);
        $event->authorized(auth()->user(), true);

        $event->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'event_date' => $request->event_date,
        ]);

        // if($request->guests){
        //     $this->DeleteEventGuests($event->guests->pluck('id'));
        //     $this->SaveEventGuests($request->guests, $event->id, $event->created_by);
        // }
        

        session()->flash('success', 'Event [<span class="font-bold">'.$event->name.'</span>] updated successfully');

        return redirect()->route('user.events.show', $event);
    }

    public function destroy(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->authorized(auth()->user(), true);

        if($event->guests){
            $this->DeleteEventGuests($event->guests->pluck('id'));
        }

        $event->tasks()->delete();
        $event->delete();

        session()->flash('success', 'Event [<span class="font-bold">'.$event->name.'</span>] deleted successfully');

        return redirect()->route('user.events.index');
    }

    private function SaveEventGuests(?array $newGuests,int $eventId, string $creator_id):void 
    {
        if($newGuests){
            array_push($newGuests, $creator_id);
        }else{
            $newGuests[] = $creator_id;
        }
        
        foreach ($newGuests as $userId) {
            Guest::create([
                'event_id' => $eventId,
                'user_id' => $userId,
            ]);
        }
    }

    private function DeleteEventGuests($previousGuests):void 
    {
        foreach ($previousGuests as $guestId){
            $guest = Guest::find($guestId);

            if ($guest) {
                if ($guest->tasks()->exists()) {
                    foreach ($guest->tasks as $task) {
                        $task->update(['status' => TaskStatus::Created]);
                        //talvez savar quem tem task e associar de novo
                        //ou se tem task no evento, n pode editar os guests
                        // ou só comento o campo do update por hora
                        //ou compado o selected com os que vieram do request e só mando salvar/deletar os de ids diferentes
                        
                    }
                    
                    $guest->tasks()->detach();
                }
            }
            
        } 

        Guest::whereIn('id', $previousGuests)->delete();
    }

}

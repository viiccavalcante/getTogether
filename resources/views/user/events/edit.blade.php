<x-site-layout title="Edit Event">
    <form action="{{route('user.events.update', $event)}}" method="post" class="w-2/3 border border-gray-300 p-4">
        @method('PUT')    
        @csrf
        <x-form-text name="name" label="Name" value="{{$event->name}}"/>
        <x-form-text name="location" label="Where?" value="{{$event->location}}"/> 
        <x-form-calendar name="event_date" label="When?" type="date" class="calendar-input" value="{{$event->event_date->format('Y-m-d')}}"/>
        <x-form-multi-select name="guests" label="Who is coming?" :options="\App\Models\User::pluck('name', 'id')->toArray()" />
        <x-form-textarea name="description" label="Describe it" placeholder="Describe your event" value="{{$event->description}}"/>

        <div class="w-full flex justify-end gap-x-8">
            <a href="{{route('user.events.show', $event)}}" class="text-xs text-gray-700 bg-gray-300 hover:bg-gray-200 px-4 py-2 rounded uppercase">Undo</a>
            <button type="submit" class="text-xs text-green-700 bg-green-300 hover:bg-green-200 px-4 py-2 rounded uppercase">Edit Event</button>
        </div>
    </form>

</x-site-layout>

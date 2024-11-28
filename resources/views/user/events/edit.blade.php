<x-site-layout title="Edit Event">
    <form action="{{route('user.events.update', $event)}}" method="post"  class="w-2/3 bg-white border border-gray-200 rounded-lg shadow-md p-4">
        @method('PUT')      
        @csrf
        
        <x-form-text name="name" label="Name" value="{{$event->name}}"/>
        <x-form-text name="location" label="Where?" value="{{$event->location}}"/> 
        <x-form-calendar name="event_date" label="When?" type="date" class="calendar-input" value="{{$event->event_date->format('Y-m-d')}}"/>
        <x-form-multi-select name="guests" label="Who is coming?" :options="$guests" :selectedOptions="$selectedGuests"/>
        <x-form-textarea name="description" label="Describe it" placeholder="Describe your event" value="{{$event->description}}"/>
        <div class="w-full flex justify-end gap-x-8">
            <a href="{{route('user.events.show', $event)}}" class="text-xs font-semibold text-gray-600 bg-gray-300 hover:bg-gray-500 px-4 py-2 rounded-full uppercase">
                Undo
            </a>
            <button type="submit" class="text-sm font-bold text-white bg-[#8e4b71] hover:bg-[#502d55] focus:outline-none py-2 px-6 rounded-full shadow-md transition-all uppercase">
                Edit Event
            </button>
        </div>
    </form>
</x-site-layout>

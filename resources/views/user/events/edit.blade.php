<x-site-layout title="Edit Event">
    <form action="{{route('user.events.update', $event)}}" method="post"  class="w-2/3 bg-white border border-gray-200 rounded-lg shadow-md p-4">
        @method('PUT')      
        @csrf
        
        <x-form-text name="name" label="Name" value="{{$event->name}}"/>
        <x-form-calendar name="event_date" label="When?" type="date" class="calendar-input" value="{{$event->event_date->format('Y-m-d')}}"/>
        <!--x-form-multi-select name="guests" label="Who is coming?" :options="$guests" :selectedOptions="$selectedGuests"/-->
        <x-form-text-area name="description" label="Describe it" placeholder="Describe your event" value="{{$event->description}}"/>
        <div class="w-full flex justify-end gap-x-8">
            <x-form-undo-hiperlink :href="route('user.events.show', $event)"></x-form-undo-hiperlink>
            <x-form-submit-button label="Edit Event"></x-form-submit-button>
        </div>
    </form>
</x-site-layout>

<x-site-layout title="Create new Event">
    <form action="{{route('user.events.store')}}" method="post" class="w-2/3 border border-gray-300 p-4">
        @csrf

        <x-form-text name="name" label="Name" placeholder="Name" />
        <x-form-text name="location" label="Where?" placeholder="Location" /> 
        <x-form-calendar name="event_date" label="When?" type="date" class="calendar-input" placeholder="Choose a date" />
        <x-form-multi-select name="guests" label="Who is coming?" :options="$guests" />
        <x-form-textarea name="description" label="Describe it" placeholder="Describe your event"/>

        <div class="w-full flex justify-end gap-x-8">
            <a href="{{route('user.events.index')}}" class="text-xs text-gray-700 bg-gray-300 hover:bg-gray-200 px-4 py-2 rounded uppercase">Undo</a>
            <button type="submit" class="text-xs text-green-700 bg-green-300 hover:bg-green-200 px-4 py-2 rounded uppercase">Create Event</button>
        </div>
    </form>

</x-site-layout>
<x-site-layout title="Create Your Event">
    <form action="{{route('user.events.store')}}" method="post"  class="w-2/3 bg-white border border-gray-200 rounded-lg shadow-md p-4">
        @csrf

        <x-form-text  name="name" label="Event Name"  placeholder="Name" class="w-full"/>
        <x-form-text name="location"  label="Where?"  placeholder="Location" class="w-full" /> 
        <x-form-calendar  name="event_date"  label="When?"  type="date"  class="calendar-input w-full" placeholder="Choose a date"  />
        <x-form-multi-select  name="guests" label="Who is coming?" :options="$guests" class="w-full" />
        <x-form-textarea  name="description"  label="Describe it"  placeholder="Write all the important details" class="w-full"/>
        <div class="flex justify-end gap-x-4 mt-4">
            <a href="{{route('user.events.index')}}" class="text-xs font-semibold text-gray-600 bg-gray-300 hover:bg-gray-500 px-4 py-2 rounded-full uppercase">
                Undo
            </a>
            <button type="submit" class="text-sm font-bold text-white bg-[#8e4b71] hover:bg-[#502d55] focus:outline-none py-2 px-6 rounded-full shadow-md transition-all uppercase">
                Create Event
            </button>
        </div>
    </form>
</x-site-layout>
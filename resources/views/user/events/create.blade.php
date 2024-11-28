<x-site-layout title="Create Your Event">
    <form action="{{route('user.events.store')}}" method="post"  class="w-2/3 bg-white border border-gray-200 rounded-lg shadow-md p-4">
        @csrf

        <x-form-text  name="name" label="Event Name"  placeholder="Name" class="w-full"/>
        <x-form-text name="location"  label="Where?"  placeholder="Location" class="w-full" /> 
        <x-form-calendar  name="event_date"  label="When?"  type="date"  class="calendar-input w-full" placeholder="Choose a date"  />
        <x-form-multi-select  name="guests" label="Who is coming?" :options="$guests" class="w-full" />
        <x-form-textarea  name="description"  label="Describe it"  placeholder="Write all the important details" class="w-full"/>
        <div class="flex justify-end gap-x-4 mt-4">
            <x-form-undo-hiperlink :href="route('user.events.index')"></x-form-undo-hiperlink>
            <x-form-submit-button label="Create"></x-form-submit-button>
        </div>
    </form>
</x-site-layout>
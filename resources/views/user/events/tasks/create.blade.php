<x-site-layout title="Create Task">
    <form action="{{route('user.events.tasks.create', $event)}}" method="post" class="w-2/3 bg-white border border-gray-200 rounded-lg shadow-md p-4">
        @csrf

        <x-form-text name="name" label="Name" placeholder="Name" />
        <x-form-text-area name="description" label="Describe it" placeholder="Describe your task"/>
        <x-form-text name="expenses" label="expenses" placeholder="How much will it costs?" />
        <x-form-multi-select name="guests" label="Assigned to" :options="$eventGuests" />

        <div class="w-full flex justify-end gap-x-8">
            <x-form-undo-hiperlink :href="route('user.events.show', $event)"></x-form-undo-hiperlink>
            <x-form-submit-button label="Create Task"></x-form-submit-button>
        </div>
    </form>

</x-site-layout>
<x-site-layout title="Create Task">
    <form action="{{route('user.events.tasks.create', $event)}}" method="post" class="w-2/3 border border-gray-300 p-4">
        @csrf

        <x-form-text name="name" label="Name" placeholder="Name" />
        <x-form-textarea name="description" label="Describe it" placeholder="Describe your task"/>
        <x-form-text name="expenses" label="expenses" placeholder="How much will it costs?" />
        <x-form-multi-select name="guests" label="Assigned to" :options="$allEventUsers" />

        <div class="w-full flex justify-end gap-x-8">
            <a href="{{route('user.events.show', $event)}}" class="text-xs text-gray-700 bg-gray-300 hover:bg-gray-200 px-4 py-2 rounded uppercase">Undo</a>
            <button type="submit" class="text-xs text-green-700 bg-green-300 hover:bg-green-200 px-4 py-2 rounded uppercase">Create Event</button>
        </div>
    </form>

</x-site-layout>
<x-site-layout title="Edit Event">

    <form action="{{route('user.events.update', $event)}}" method="post" class="w-2/3 border border-gray-300 p-4" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <x-form-text name="name" label="Name" value="{{$event->name}}"/>
        <x-form-text name="location" label="Location" value="{{$event->location}}"/>
        <x-form-textarea name="description" label="Event Description" value="{{$event->description}}" placeholder="Describe you nice events to your guests!"/>
        @include('components.form._form-error-handling');


        <div class="w-full flex justify-end gap-x-8">
            <a href="{{route('user.events.index')}}" class="text-xs text-gray-700 bg-gray-300 hover:bg-gray-200 px-4 py-2 rounded uppercase">Undo</a>
            <button type="submit" class="text-xs text-green-700 bg-green-300 hover:bg-green-200 px-4 py-2 rounded uppercase">Save changes</button>
        </div>
    </form>

</x-site-layout>


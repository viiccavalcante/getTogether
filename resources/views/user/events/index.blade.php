<x-site-layout title="Created by me">

    <div class="flex justify-end mb-4">
        <a class="text-xs text-green-700 bg-purple-300 px-1 py-.5 rounded" href="">Active Events Only</a>
        <a class="text-xs text-green-700 bg-green-300 px-1 py-.5 rounded" href="{{route('user.events.create')}}">Start an Event</a>
    </div>


    @if(session()->has('success'))
        <div class="bg-green-100 text-green-500 p-2">
            {!! session()->get('success') !!}
        </div>
    @endif


    <table class="table-auto w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-300 ">
                <th>Events</th>
            </tr>
        </thead>

        <tbody>
            @foreach($events as $event)
                <tr class="hover:bg-gray-200 border-b border-gray-200">
                    <td><a href="">{{$event->name}}</a></td>
                    <td class="flex gap-x-4 justify-center items-center">
                        <a href="{{route('user.events.show', $event)}}" class="text-xs text-blue-700 bg-blue-300 px-1 py-.5 rounded uppercase">Details</a>
                        <form action="{{route('user.events.destroy', $event)}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="text-xs text-red-700 bg-red-300 px-1 py-.5 rounded uppercase">delete</button>
                        </form>
                    </td>
                <tr/>
            @endforeach
        </tbody>
    </table>

</x-site-layout>

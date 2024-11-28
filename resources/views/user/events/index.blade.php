<x-site-layout title="My Events">
    <div class="flex justify-start mb-4">
        <a class="text-sm font-bold text-white bg-[#8e4b71] hover:bg-[#502d55] focus:outline-none py-2 px-6 rounded-full shadow-md transition-all uppercase" href="{{route('user.events.create')}}">Create Event</a>
    </div>

    @if(session()->has('success'))
        <div class="bg-green-100 text-green-500 p-2">
            {!! session()->get('success') !!}
        </div>
    @endif  

    <div>
        {{$events->links() }}
    </div>

    @foreach($events as $event)
        <div class="rounded-lg border border-gray-200 bg-white shadow-lg p-6 transition-shadow hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <h3 class="text-xl font-bold text-[#381841]">{{$event->name}}</h3>
                    <h3 class="text-xl font-bold text-orange-300"> ({{$event->event_date->format('M-d-y')}})</h3>
                </div>
                <span class="text-sm text-gray-500">(Participants: {{$event->guests->count() + 1}})</span> <!--ta errada essa conta -->
            </div>
            <div class="text-sm text-gray-500 mb-4">
                {{$event->location}}
            </div>
        
            <div class="flex items-center justify-between">
                <a href="{{route('user.events.show', $event)}}" 
                class="text-sm text-white bg-[#8e4b71] hover:bg-[#502d55] px-2 py-0.5 rounded-full font-semibold transition-colors uppercase">
                    Details
                </a>
                <form action="{{route('user.events.destroy', $event)}}" method="post" class="inline-block">
                    @method('delete')
                    @csrf
                    <button type="submit" 
                            class="text-sm text-orange-50 bg-orange-400 hover:bg-orange-600 px-2 py-0.5 rounded-full font-semibold transition-colors uppercase">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</x-site-layout>

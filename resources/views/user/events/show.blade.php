<x-site-layout title="Event Detail">
    <div class="rounded-lg border border-gray-200 bg-white shadow-lg p-6 transition-shadow hover:shadow-xl">
        <div class="flex items-center space-x-4 justify-between">
            <div class="flex items-center space-x-4">
                <h3 class="font-bold text-2xl text-[#381841]">{{ $event->name }}</h3>
                <h1 class="font-bold text-xl text-orange-500">({{ $event->event_date->format('M-d-y') }})</h1>
            </div>
            <div class="flex space-x-4 ml-auto">
                <a href="{{ route('user.events.tasks.create', $event) }}" class="text-xs text-white bg-pink-500 hover:bg-pink-600 px-4 py-2 rounded-lg uppercase font-semibold transition-colors">
                    Create Task
                </a>
                <a href="{{ route('user.events.edit', $event) }}" class="text-xs text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg uppercase font-semibold transition-colors">
                    Edit
                </a>
            </div>
        </div>

        <div class="text-m text-gray-500 mb-1 ">
            Created by:</span> {{$event->creator->name}}
        </div>
        <div class="font-medium text-gray-800">
            {{$event->location}}
        </div>
        <div class="text-gray-800 max-w-3xl pt-2">
            {{$event->description}}
        </div>

        <div class="font-medium text-gray-800 mt-4">
            <span class="font-semibold text-lg text-gray-900">Guests</span>
            <div class="flex flex-wrap gap-2 mt-2">
                @foreach($event->guests as $guest)
                    <div class="inline-flex items-center space-x-2 text-gray-700 bg-[#c598af] hover:bg-purple-200 text-white px-3 py-1 rounded-full cursor-pointer transition-all">
                        <span>{{ $guest->user->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="font-medium text-gray-800 mt-4">
            <span class="font-semibold text-lg text-gray-900">Tasks</span>
            <div class="space-y-1">
                @foreach($event->tasks as $task)
                <div class="bg-purple-100 hover:bg-gray-200 p-2 rounded-lg shadow-sm transition-colors">
                <span class="text-gray-700">{{ $task->name }}</span>
                        <a href="{{route('user.events.edit', $event)}}" 
                            class="text-xs text-white bg-green-500 hover:bg-green-600 px-2 py-1 rounded-lg uppercase font-semibold transition-colors">
                                Mark as Complete
                            </a>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
</x-site-layout>

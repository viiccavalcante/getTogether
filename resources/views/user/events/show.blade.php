<x-site-layout title="Event Detail">
    <div class="rounded-lg border border-gray-200 bg-white shadow-lg p-6 transition-shadow hover:shadow-xl">
    <div class="flex items-center justify-between space-x-4">
    <div class="flex items-center space-x-4">
        <h3 class="font-bold text-2xl text-[#381841]">{{ $event->name }}</h3>
        <h1 class="font-bold text-xl text-orange-500">({{ $event->event_date->format('M-d-y') }})</h1>
    </div>
    <div class="flex space-x-4">
        <a class="text-sm font-bold text-white bg-[#FB923C] hover:bg-[#FB923C] focus:outline-none py-2 px-6 rounded-md shadow-md transition-all uppercase" href="{{ route('user.events.tasks.create', $event) }}">
            Create Task
        </a>
        <x-primary-hiperlink href="{{ route('user.events.edit', $event) }}" action="Edit Event"/>
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
            <div class="space-y-4">
    @foreach($event->tasks as $task)
        <div class="bg-white hover:bg-gray-50 p-4 rounded-lg shadow-md border border-gray-200 transition-colors">
            <div class="flex justify-between items-center">
                <div class="flex-1">
                    <span class="font-semibold text-lg text-gray-800">{{ $task->name }}</span>
                    <p class="font-normal text-sm text-gray-600">{{ $task->description }}</p>
                </div>
                <x-show-task-status status="{{$task->status->name}}"></x-show-task-status>
            </div>
            <div class="mt-2 flex justify-between items-center">
                <span class="text-sm text-gray-500">{{ $task->expenses ? 'R$' . number_format($task->expenses, 2, ',', '.') : 'No Cost' }}</span>
                <form action="{{route('user.events.destroy', $event)}}" method="post" class="inline-block">
                    @method('delete')
                    @csrf
                    <x-delete-button></x-delete-button>
                </form>
            </div>
            <a href="{{ route('user.events.edit', $event) }}" 
                    class="text-xs text-white bg-[#FB923C] hover:bg-[#FF7F2A] px-3 py-1 rounded-lg uppercase font-semibold transition-colors">
                    Mark as Done
                </a>
        </div>
    @endforeach
</div>

            </div>
        </div>
    </div>
</x-site-layout>

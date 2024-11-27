<x-site-layout title="{{$event->name}}">
    <a href="{{route('user.events.edit', $event)}}" class="text-xs text-blue-700 bg-blue-300 px-1 py-.5 rounded uppercase">edit</a>
    <a href="{{route('user.events.index')}}" class="text-xs text-blue-700 bg-purple-300 px-1 py-.5 rounded uppercase">back</a>
    <a href="{{route('user.events.tasks.create', $event)}}" class="text-xs text-blue-700 bg-pink-300 px-1 py-.5 rounded uppercase">create task</a>
    <div>Created by {{$event->creator->name}}</div>
    <div>Where? {{$event->location}}</div>
    <div>When? {{$event->event_date->format('M-d')}}</div>
    <div>Guests</div>
    <div>@foreach($event->guests as $guest) {{$guest->user->name}} @endforeach</div>
    {{$event->description}}
</x-site-layout>

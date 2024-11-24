<x-site-layout title="{{$event->name}}">

    <div>by {{$event->creator->name}}</div>

    {{$event->description}}
</x-site-layout>

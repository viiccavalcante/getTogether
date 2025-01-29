<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Resources\EventIndexResource;
use App\Http\Resources\EventShowResource;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(100);

        return EventIndexResource::collection($events);
    }

    public function show(string $eventId)
    {
        $event = Event::with('creator')->where('id', $eventId)->sole();

        return new EventShowResource($event);
    }
}
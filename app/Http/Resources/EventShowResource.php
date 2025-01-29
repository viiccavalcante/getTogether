<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventShowResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'date' => $this->event_date?->format('d-m-Y'),
            'location' => $this->location,
            'description' => $this->description,
            'created_by' => new CreatorResource($this->creator),
            'participants' => $this->guests->pluck('user.name'),
            'tasks' => TasksResource::collection($this->tasks),
        ];
    }
}

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
            'creator' => new CreatorResource($this->creator),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
   
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'status' => $this->status,
            'description' => $this->description,
            'expenses' => $this->expenses,
            'assigned_to' => $this->guests->pluck('user.name'),
        ];
    }
}

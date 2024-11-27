<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatus;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $casts = [
        'status' => TaskStatus::class,
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'guest_task');
    }
}

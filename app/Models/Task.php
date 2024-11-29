<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatus;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => TaskStatus::class,
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'participant_task', 'task_id', 'participant_id');
    }
}

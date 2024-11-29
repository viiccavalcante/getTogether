<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'event_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants', 'event_id', 'user_id')
                ->using(Participant::class);
    }

    public function authorized(User $user, bool $creatorOnly): void
    {
        if ($this->created_by == $user->id) {
            return;
        }

        if(!$creatorOnly && (in_array($user->id, $this->participants()->pluck('user_id')->toArray()))) {
            return;
        }

        abort(401);
    }
}

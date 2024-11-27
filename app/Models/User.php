<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function guests()
    {
        return $this->hasMany(Guest::class, 'user_id');
    }

    // Model scopes --------
    public function scopeGetAllExcept($query, $event_creator_id)
    {
        return $query->select('id', 'name')
                     ->where('id', '<>', $event_creator_id)
                     ->orderBy('name', 'asc');
    }

       // Model scopes --------
    public function scopeGetAllFromGuests($query, $eventId)
    {
        return $query->select('users.id', 'users.name')
                     ->join('guests', 'users.id', '=', 'guests.user_id')
                     ->where('guests.event_id', $eventId)
                     ->orderBy('name', 'asc');
    }
}
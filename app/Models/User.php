<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'date_of_birth',
        'type',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
        ];
    }

    // Relationships
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function activeContract()
    {
        return $this->hasOne(Contract::class)->where('status', 'Active');
    }

    public function playerStats()
    {
        return $this->hasOne(PlayerStats::class);
    }

    public function coachStats()
    {
        return $this->hasOne(CoachStats::class);
    }

    public function refereeStats()
    {
        return $this->hasOne(RefereeStats::class);
    }

    public function teamStats()
    {
        return $this->hasOne(TeamStats::class, 'team_id');
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->type === 'admin';
    }

    public function isTeam()
    {
        return $this->type === 'team';
    }

    public function isPerson()
    {
        return $this->type === 'person';
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}

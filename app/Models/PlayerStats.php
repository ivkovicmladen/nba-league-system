<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points',
        'rebounds',
        'assists',
        'games_played',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPointsPerGameAttribute()
    {
        return $this->games_played > 0 
            ? round($this->points / $this->games_played, 2) 
            : 0;
    }

    public function getReboundsPerGameAttribute()
    {
        return $this->games_played > 0 
            ? round($this->rebounds / $this->games_played, 2) 
            : 0;
    }

    public function getAssistsPerGameAttribute()
    {
        return $this->games_played > 0 
            ? round($this->assists / $this->games_played, 2) 
            : 0;
    }
}
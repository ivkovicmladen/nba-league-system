<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'games_played',
        'wins',
        'losses',
        'points_scored',
        'points_conceded',
    ];

    public function team()
    {
        return $this->belongsTo(User::class, 'team_id');
    }

    public function getWinRateAttribute()
    {
        return $this->games_played > 0 
            ? round($this->wins / $this->games_played, 4) 
            : 0;
    }

    public function getPointDifferentialAttribute()
    {
        return $this->points_scored - $this->points_conceded;
    }
}
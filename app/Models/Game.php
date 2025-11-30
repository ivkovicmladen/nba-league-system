<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'team1_id',
        'team2_id',
        'points1',
        'points2',
        'referee_id',
        'date',
        'referee_rating',
        'game_status',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function team1()
    {
        return $this->belongsTo(User::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(User::class, 'team2_id');
    }

    public function referee()
    {
        return $this->belongsTo(User::class, 'referee_id');
    }

    public function getWinnerAttribute()
    {
        if ($this->points1 > $this->points2) {
            return $this->team1;
        }
        return $this->team2;
    }
}
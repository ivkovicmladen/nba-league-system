<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefereeStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points',
        'games_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->games_count > 0 
            ? round($this->points / $this->games_count, 2) 
            : 0;
    }
}
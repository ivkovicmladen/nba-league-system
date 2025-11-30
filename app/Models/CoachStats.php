<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wins',
        'losses',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getWinLossPercentageAttribute()
    {
        $total = $this->wins + $this->losses;
        return $total > 0 ? round($this->wins / $total, 4) : 0;
    }
}
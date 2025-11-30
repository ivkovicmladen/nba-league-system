<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_from',
        'date_to',
        'status',
        'salary',
        'role',
        'employer_id',
    ];

    protected function casts(): array
    {
        return [
            'date_from' => 'date',
            'date_to' => 'date',
            'salary' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function accept()
    {
        $this->status = 'Active';
        $this->date_from = now();
        $this->save();

        // Create stats record based on role
        if ($this->role === 'player') {
            PlayerStats::firstOrCreate(['user_id' => $this->user_id]);
        } elseif ($this->role === 'coach') {
            CoachStats::firstOrCreate(['user_id' => $this->user_id]);
        } elseif ($this->role === 'referee') {
            RefereeStats::firstOrCreate(['user_id' => $this->user_id]);
        }
    }

    public function terminate()
    {
        $this->status = 'Terminated';
        $this->date_to = now();
        $this->save();
    }

    public function isPending()
    {
        return $this->status === 'Pending';
    }

    public function isActive()
    {
        // Check if expired
        if ($this->status === 'Active' && $this->date_to && $this->date_to < now()) {
            $this->update(['status' => 'Completed']);
            return false;
        }
        return $this->status === 'Active';
    }

    public function isExpired()
    {
        return $this->date_to && $this->date_to < now();
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'Active' => 'green',
            'Completed' => 'gray',
            'Pending' => 'yellow',
            'Rejected' => 'red',
            'Terminated' => 'orange',
            default => 'gray',
        };
    }
}
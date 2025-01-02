<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrinkSession extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'session_date', 'check_in_time', 'check_out_time', 'pitchers'];

    protected static function boot()
    {
        parent::boot();

        // Handle new session creation
        static::created(function ($session) {
            Score::updateUserScore($session->user_id, $session->pitchers);
        });

        // Handle session updates
        static::updated(function ($session) {
            $previousPitchers = $session->getOriginal('pitchers');
            $difference = $session->pitchers - $previousPitchers;
            if ($difference > 0) {
                Score::updateUserScore($session->user_id, $difference);
            } else {
                Score::decreaseUserScore($session->user_id, abs($difference));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
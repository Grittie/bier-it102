<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'pitchers',
        'shame',
        'user_id',
    ];

    public static function getTotalPitchers()
    {
        return static::sum('pitchers');
    }

    public static function getTotalLiter()
    {
        return static::sum('pitchers') * 1.8;
    }

    public static function getTotalPrice()
    {
        return static::sum('pitchers') * 13;
    }
}

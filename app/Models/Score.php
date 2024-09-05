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

    // Define constants for magic numbers
    private const LITER_CONVERSION_FACTOR = 1.8;
    private const PRICE_PER_PITCHER = 14;

    public static function getTotalPitchers()
    {
        return static::sum('pitchers');
    }

    public static function getTotalLiter()
    {
        return static::sum('pitchers') * self::LITER_CONVERSION_FACTOR;
    }

    public static function getTotalPrice()
    {
        return static::sum('pitchers') * self::PRICE_PER_PITCHER;
    }
}

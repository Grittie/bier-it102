<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreY2 extends Model
{
    use HasFactory;

    // Define the table name if it's not the pluralized version of the model name
    protected $table = 'scoresy2';

    // Define fillable fields if needed
    protected $fillable = [
        'user_id',
        'pitchers',
        // Add other fields as necessary
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

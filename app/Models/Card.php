<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $primaryKey = 'card_id';
    protected $fillable = [
        'user_id',
        'rfid_tag',
        'status',
        'issue_date',
        'expiry_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

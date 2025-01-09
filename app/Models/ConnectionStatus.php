<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectionStatus extends Model
{
    use HasFactory;

    protected $table = 'connection_status';

    protected $fillable = ['timestamp', 'status'];
}

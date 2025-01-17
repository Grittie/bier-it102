<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalTemperature extends Model
{
    use HasFactory;

    protected $table = 'internal_temperature';

    protected $fillable = ['timestamp', 'temperature', 'humidity'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'active',
        'description',
        'quantity',
        'time_start',
        'time_end',
        'address',
        'user_id',
        'event_id'
    ];


}
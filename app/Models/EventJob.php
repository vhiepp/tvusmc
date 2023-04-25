<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
        'event_id',
        'job_id'
    ];

}

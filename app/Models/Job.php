<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'active',
        'description',
        'quantity',
        'time_start',
        'time_end',
        'user_id'
    ];
}

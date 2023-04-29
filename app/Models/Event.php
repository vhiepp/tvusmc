<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'active',
        'description',
        'content',
        'thumb',
        'time_start',
        'time_end',
        'address',
        'user_id',
        'category_id'
    ];
}

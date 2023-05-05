<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // public $timestamps = FALSE;

    protected $fillable = [
        'title', 'slug', 'content', 'thumb', 'active', 'user_id', 'category_id', 'created_at',
    ];
}

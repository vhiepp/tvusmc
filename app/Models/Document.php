<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Cviebrock\EloquentSluggable\Sluggable;

class Document extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumb',
        'active',
        'user_id',
        'created_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->thumb = $query->thumb ?? '/assets/img/doc.png';
            $query->user_id = auth()->user()['id'];
        });

        static::retrieved(function ($query) {
            $query->post_at = Date('d/m/Y', strtotime($query->created_at));
            $query->files_count = $query->files->count();
        });
    }

    public function files(): HasMany
    {
        return $this->hasMany(DocumentFile::class, 'document_id', 'id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
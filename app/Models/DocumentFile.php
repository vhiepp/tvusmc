<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DocumentFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'file_url',
        'document_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'document_id'
    ];

    public function document(): HasOne
    {
        return $this->hasOne(Document::class);
    }
}
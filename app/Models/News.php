<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'summary', 'content', 'image', 
        'category', 'is_featured', 'published_at'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];
}
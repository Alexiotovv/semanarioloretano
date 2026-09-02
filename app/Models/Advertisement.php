<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'title', 'image', 'link', 'description', 
        'position', 'is_active', 'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
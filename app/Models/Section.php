<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $fillable = [
        'title', 'show_in_nav',
    ];

    protected $casts = [
        'show_in_nav' => 'boolean',
    ];

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }
}
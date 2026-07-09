<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'image',
        'excerpt',
        'content',
        'published_at',
        'is_published',
        'show_on_home',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'boolean',
        'show_on_home' => 'boolean',
    ];
}
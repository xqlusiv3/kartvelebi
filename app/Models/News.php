<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', now());
    }

    public function scopeForHome(Builder $query): Builder
    {
        return $query->where('show_on_home', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->image);
    }
}
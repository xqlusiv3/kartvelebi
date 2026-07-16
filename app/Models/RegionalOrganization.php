<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RegionalOrganization extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'type',
        'federal_district',
        'region',
        'city',
        'address',
        'show_address',
        'latitude',
        'longitude',
        'location_precision',
        'leader_name',
        'leader_position',
        'leader_photo',
        'leader_bio',
        'phone',
        'email',
        'website',
        'social_links',
        'short_description',
        'description',
        'work_hours',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'show_address' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'social_links' => 'array',
        'is_published' => 'boolean',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function getLeaderPhotoUrlAttribute(): ?string
    {
        if (! $this->leader_photo) {
            return null;
        }

        return Storage::disk('public')->url($this->leader_photo);
    }

    public function getPublicAddressAttribute(): ?string
    {
        if (! $this->show_address || ! $this->address) {
            return null;
        }

        return $this->address;
    }

    public function getLocationLabelAttribute(): string
    {
        return collect([$this->city, $this->region])
            ->filter()
            ->unique()
            ->implode(', ');
    }
}

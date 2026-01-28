<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HeroSection extends Model
{
    protected $fillable = [
        'page_key',
        'tag',
        'title',
        'description',
        'primary_image',
        'secondary_image',
        'status',
    ];

    public function repeaters(): HasMany
    {
        return $this->hasMany(HeroRepeater::class);
    }

    // COUNTERS relationship
    public function counters(): HasMany
    {
        return $this->hasMany(HeroRepeater::class)
            ->where('type', 'counters')
            ->with('fields');
    }

    // EXPERIENCE BADGES relationship
    public function experienceBadges(): HasMany
    {
        return $this->hasMany(HeroRepeater::class)
            ->where('type', 'experience_badges')
            ->with('fields');
    }

    // CLIENT REVIEW (if only one)
    public function clientReview()
    {
        return $this->hasMany(HeroRepeater::class)
            ->where('type', 'client_reviews')
            ->with('fields')
            ->first(); // just one review
    }

    /* =====================
     * COUNTERS
     * ===================== */
    public function getCountersAttribute()
    {
        return $this->repeaters->where('type', 'counters');
    }

    /* =====================
     * CLIENT REVIEW
     * ===================== */
    public function getClientReviewAttribute()
    {
        return $this->repeaters->firstWhere('type', 'client_reviews');
    }
}

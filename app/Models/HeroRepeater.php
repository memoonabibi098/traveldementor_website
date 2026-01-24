<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HeroRepeater extends Model
{
    protected $fillable = [
        'hero_section_id',
        'type',
        'sort_order',
    ];

    public function heroSection(): BelongsTo
    {
        return $this->belongsTo(HeroSection::class);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(HeroRepeaterField::class);
    }
}

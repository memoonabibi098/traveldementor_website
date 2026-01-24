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
}

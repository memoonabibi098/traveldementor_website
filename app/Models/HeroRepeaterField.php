<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HeroRepeaterField extends Model
{
    protected $fillable = [
        'hero_repeater_id',
        'field_key',
        'field_value',
        'suffix',
    ];

    public function repeater(): BelongsTo
    {
        return $this->belongsTo(HeroRepeater::class);
    }
}

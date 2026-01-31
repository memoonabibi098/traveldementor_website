<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AchievementsItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'section_id',
        'icon',
        'number',
        'heading',
        'description',
        'order',
        'status'
    ];

    // Each item belongs to a section
    public function section()
    {
        return $this->belongsTo(AchievementsSection::class, 'section_id');
    }
}

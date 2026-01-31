<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AchievementsSection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'main_heading',
        'description',
        'image',
        'order',
        'status'
    ];

    // One section has many items
    public function items()
    {
        return $this->hasMany(AchievementsItem::class, 'section_id');
    }
}

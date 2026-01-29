<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChooseUsSection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'page_key',
        'heading',
        'description',
        'main_image',
        'status',
    ];

    // Relationship to points
    public function points()
    {
        return $this->hasMany(ChooseUsPoint::class, 'section_id')->orderBy('order', 'asc');
    }
}

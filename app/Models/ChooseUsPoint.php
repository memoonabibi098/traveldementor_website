<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChooseUsPoint extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'section_id',
        'icon_image',
        'heading',
        'description',
        'order',
        'status',
    ];

    // Relationship back to section
    public function section()
    {
        return $this->belongsTo(ChooseUsSection::class, 'section_id');
    }
}

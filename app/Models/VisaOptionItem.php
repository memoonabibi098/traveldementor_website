<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaOptionItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'section_id',
        'title',
        'description',
        'image',
        'status',
        'order',
    ];

    public function section()
    {
        return $this->belongsTo(VisaOptionSection::class, 'section_id');
    }

    public function counters()
    {
        return $this->hasMany(VisaOptionCounter::class, 'item_id')
            ->orderBy('order', 'asc');
    }
}

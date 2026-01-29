<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopularDestinationItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['section_id', 'image', 'text', 'status', 'order'];

    public function section()
    {
        return $this->belongsTo(PopularDestinationSection::class, 'section_id');
    }
}

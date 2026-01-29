<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopularDestinationSection extends Model
{
    use SoftDeletes;

    protected $fillable = ['page_key', 'sub_heading', 'heading', 'status', 'order'];

    public function items()
    {
        return $this->hasMany(PopularDestinationItem::class, 'section_id')->orderBy('order');
    }
}

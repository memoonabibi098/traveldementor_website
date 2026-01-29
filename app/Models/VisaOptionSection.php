<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaOptionSection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'page_key',
        'heading',
        'description',
        'status',
        'order',
    ];

    public function items()
    {
        return $this->hasMany(VisaOptionItem::class, 'section_id')
                    ->orderBy('order', 'asc');
    }
}

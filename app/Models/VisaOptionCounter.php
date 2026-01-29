<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaOptionCounter extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'value',
        'suffix',
        'label',
        'order',
    ];

    /**
     * Counter belongs to a Visa Option Item
     */
    public function item()
    {
        return $this->belongsTo(VisaOptionItem::class, 'item_id');
    }
}

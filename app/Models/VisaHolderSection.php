<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaHolderSection extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'visa_holder_sections'; // custom table name
    protected $fillable = ['title', 'description', 'order', 'status'];

    public function items()
    {
        return $this->hasMany(VisaHolderItem::class, 'section_id')
            ->orderBy('order');
    }
}

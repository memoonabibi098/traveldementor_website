<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaHolderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'visa_holders_item'; // custom table name
    protected $fillable = ['section_id', 'title', 'description', 'image', 'order', 'status'];

    public function section()
    {
        return $this->belongsTo(VisaHolderSection::class, 'section_id');
    }
}

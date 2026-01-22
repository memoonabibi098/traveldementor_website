<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $fillable = [
        'logo',
        'menus',
        'button_text',
        'button_url',
        'status',
    ];

    protected $casts = [
        'menus' => 'array',
        'status' => 'boolean',
    ];
}

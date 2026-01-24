<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
        'logo',
        'intro_text',
        'newsletter_text',
        'company_links',
        'phone',
        'email',
        'address',
        'facebook',
        'instagram',
        'mail',
        'linkedin',
        'youtube',
        'copyright_text',
        'status',
    ];

    protected $casts = [
        'company_links' => 'array',
        'status' => 'boolean',
    ];
}

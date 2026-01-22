<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminUser extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'adminusers';

    // Mass assignable fields
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'picture',
        'address',
        'password',
        'role',
        'status',
        'email_verified',
        'last_login_at',
    ];

    // Hidden fields (like password)
    protected $hidden = [
        'password',
    ];

    // Casts
    protected $casts = [
        'status' => 'boolean',
        'last_login_at' => 'datetime',
        'email_verified' => 'boolean', // add this
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailOtp extends Model
{
    use HasFactory;

    protected $table = 'email_otps';

    protected $fillable = [
        'adminuser_id',
        'otp',
        'expires_at',
        'is_used',
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'expires_at' => 'datetime',
    ];

    // Relation to AdminUser
    public function adminuser()
    {
        return $this->belongsTo(AdminUser::class);
    }
}

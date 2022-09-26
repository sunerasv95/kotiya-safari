<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email', 'username', 'name', 'role_id'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class)->with('permissions');
    }

    public function user_type(): BelongsTo
    {
        return $this->belongsTo(UserType::class);
    }
}

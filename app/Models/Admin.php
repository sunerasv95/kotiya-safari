<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        "name",
        "email",
        "role_id"
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class)->with('permissions');
    }

    public function remarks(): HasMany
    {
        return $this->hasMany(Remarks::class);
    }
}

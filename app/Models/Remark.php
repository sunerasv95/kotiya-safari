<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Remark extends Model
{
    use HasFactory;

    public function remarkable()
    {
        return $this->morphTo();
    }

    public function remarked_user(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'remarked_by');
    }
}

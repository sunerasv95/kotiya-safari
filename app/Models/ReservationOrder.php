<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationOrder extends Model
{
    use HasFactory;

    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class)->with('country');
    }

    public function remarks()
    {
        return $this->morphMany(Remark::class, 'remarkable');
    }
}

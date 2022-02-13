<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    public function reservationOrder()
    {
        return $this->hasOne(ReservationOrder::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function vass()
    {
        return $this->belongsToMany(VAS::class, "inquiry_value_added_service", "inquiry_id");
    }
}

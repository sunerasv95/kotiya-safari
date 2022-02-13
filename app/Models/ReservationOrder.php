<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationOrder extends Model
{
    use HasFactory;

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function reservationOrderDetails()
    {
        return $this->hasOne(ReservationOrderDetail::class, "order_reference_no", "order_reference_no");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationOrderDetail extends Model
{
    use HasFactory;

    public function reservationOrder()
    {
        return $this->belongsTo(ReservationOrder::class, "order_reference_no", "order_reference_no");
    }
}

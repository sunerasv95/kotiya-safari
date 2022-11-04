<?php

namespace App\Models;

use App\Constants\UserTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        "checkin_date",
        "checkout_date",
        "no_adults",
        "no_kids"
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function reservation_order(): HasOne
    {
        return $this->hasOne(ReservationOrder::class, "inquiry_id");
    }

    public function remarks()
    {
        return $this->morphMany(Remark::class, 'remarkable')->with('remarked_user:id,admin_code,name');
    }
}

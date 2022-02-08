<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VAS extends Model
{
    use HasFactory;

    protected $table = "value_added_services";

    public function scopeActive($q)
    {
        return $q->where("status", 1);
    }

    public function inquiries()
    {
        return $this->belongsToMany(Inquiry::class, "inquiry_value_added_service", "v_a_s_id");
    }
}

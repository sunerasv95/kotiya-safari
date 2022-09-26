<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Guest extends Model
{
    use HasFactory;
    use Notifiable;

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use HasFactory;
    use Notifiable;


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }
}

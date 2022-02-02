<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function blogPostImages()
    {
        return $this->hasMany(BlogPostImage::class);
    }
}

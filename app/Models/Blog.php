<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    function BlogComment()
    {
        return $this->hasMany(BlogComment::class, 'blog_id');
    }
    function BlogReply()
    {
        return $this->hasMany(BlogReply::class, 'blog_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;
    function Blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
    function BlogReply()
    {
        return $this->hasMany(BlogReply::class, 'blogcomment_id');
    }
}

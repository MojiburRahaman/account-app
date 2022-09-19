<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogReply extends Model
{
    use HasFactory;
    function Blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
    function BlogComment()
    {
        return $this->belongsTo(BlogComment::class, 'blogcomment_id');
    }
}

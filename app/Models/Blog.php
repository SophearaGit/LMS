<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }
    public function blog_author()
    {
        return $this->belongsTo(Admin::class, 'user_id', 'id');

    }
    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_id', 'id');
    }
}

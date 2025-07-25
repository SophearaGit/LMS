<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id', 'id');
    }
}

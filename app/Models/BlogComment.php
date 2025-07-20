<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = [
        'user_id',
        'blog_id',
        'comment',
    ];

    // belong to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}

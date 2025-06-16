<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'rating',
        'review',
        'user_image',
        'user_name',
        'user_title',
    ];
}

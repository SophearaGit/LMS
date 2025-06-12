<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedInstructorSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'button_text',
        'button_url',
        'instructor_id',
        'featured_courses',
        'instructor_image',
    ];
}

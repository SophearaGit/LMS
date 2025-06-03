<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsSection extends Model
{
    protected $fillable = [
        'image',
        'rounded_text',
        'lerner_count',
        'lerner_count_text',
        'lerner_image',
        'title',
        'description',
        'button_text',
        'button_url',
        'video_url',
        'video_image'
    ];
}

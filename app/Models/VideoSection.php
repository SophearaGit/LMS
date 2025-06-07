<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoSection extends Model
{
    protected $fillable = [
        'background_image',
        'video_url',
        'description',
        'button_text',
        'button_url',
    ];
}

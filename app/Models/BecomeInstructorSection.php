<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BecomeInstructorSection extends Model
{
    protected $fillable = [
        'icon',
        'label',
        'title',
        'description',
        'btn_txt',
        'btn_txt_url',
        'btn_icon',
        'img',
    ];
}

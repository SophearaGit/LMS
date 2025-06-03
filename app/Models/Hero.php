<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    /** @use HasFactory<\Database\Factories\HeroFactory> */
    use HasFactory;

    protected $fillable = [
        'label',
        'title',
        'subtitle',
        'btn_txt',
        'btn_url',
        'vid_btn_txt',
        'vid_btn_url',
        'banner_item_title',
        'banner_item_subtitle',
        'image',
        'round_txt',
    ];



}

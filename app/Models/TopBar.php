<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopBar extends Model
{
    protected $fillable = [
        'email',
        'phone',
        'offer_name',
        'offer_description',
        'offer_button_link',
        'offer_button_text',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentSettingFactory> */
    use HasFactory;
    protected $fillable = [
        'key',
        'value',
    ];
}

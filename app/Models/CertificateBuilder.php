<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateBuilder extends Model
{
    /** @use HasFactory<\Database\Factories\CertificateBuilderFactory> */
    use HasFactory;
    protected $fillable = [
        'background',
        'title',
        'subtitle',
        'description',
        'signature',
    ];

}

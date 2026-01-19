<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorPayoutInformation extends Model
{
    /** @use HasFactory<\Database\Factories\InstructorPayoutInformationFactory> */
    use HasFactory;
    protected $fillable = [
        'instructor_id',
        'gateway',
        'information',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }
}

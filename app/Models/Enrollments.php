<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollments extends Model
{
    /** @use HasFactory<\Database\Factories\EnrollmentsFactory> */
    use HasFactory;

    // belong to course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }


}

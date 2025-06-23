<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLevel extends Model
{
    /** @use HasFactory<\Database\Factories\CourseLevelFactory> */
    use HasFactory;

    // course level should have many courses
    public function courses()
    {
        return $this->hasMany(Course::class, 'course_level_id');
    }

}

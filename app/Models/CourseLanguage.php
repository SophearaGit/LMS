<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLanguage extends Model
{
    /** @use HasFactory<\Database\Factories\CourseLanguageFactory> */
    use HasFactory;

    // course language should have many courses
    public function courses()
    {
        return $this->hasMany(Course::class, 'course_language_id');
    }
}

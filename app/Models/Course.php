<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    public function instructor(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'instructor_id');
    }

    public function category(): HasOne
    {
        return $this->hasOne(CourseCategory::class, 'id', 'category_id');
    }

    public function level(): HasOne
    {
        return $this->hasOne(CourseLevel::class, 'id', 'course_level_id');
    }
    public function language(): HasOne
    {
        return $this->hasOne(CourseLanguage::class, 'id', 'course_language_id');
    }
    public function chapters(): HasMany
    {
        return $this->hasMany(CourseChapter::class, 'course_id', 'id')->orderBy('order');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(CourseChapterLessons::class, 'course_id', 'id');
    }

}

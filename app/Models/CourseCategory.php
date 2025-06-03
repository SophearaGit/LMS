<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseCategory extends Model
{
    /** @use HasFactory<\Database\Factories\CourseCategoryFactory> */
    use HasFactory;
    public function subCategories(): HasMany
    {
        return $this->hasMany(CourseCategory::class, 'parent_id');
    }

    // course count
    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id');
    }




}

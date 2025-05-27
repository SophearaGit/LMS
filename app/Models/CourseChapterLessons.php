<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseChapterLessons extends Model
{
    /** @use HasFactory<\Database\Factories\CourseChapterLessonsFactory> */
    use HasFactory;

    public function history(): BelongsTo
    {
        return $this->belongsTo(MakeHistory::class, 'id', 'lesson_id');
    }

}

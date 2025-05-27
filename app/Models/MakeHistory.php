<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakeHistory extends Model
{
    /** @use HasFactory<\Database\Factories\MakeHistoryFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'chapter_id',
        'lesson_id',
        'is_completed',
    ];
}

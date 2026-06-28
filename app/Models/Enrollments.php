<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Enrollments extends Model
{
    /** @use HasFactory<\Database\Factories\EnrollmentsFactory> */
    use HasFactory;
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

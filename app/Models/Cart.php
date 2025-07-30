<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    // belongs to course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    // belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // has many course
    public function courses()
    {
        return $this->hasMany(Course::class, 'id', 'course_id');
    }



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['description', 'student_id', 'course_id', 'grade'];

    public function courseModule()
    {
        return $this->belongsTo(CourseModule::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}

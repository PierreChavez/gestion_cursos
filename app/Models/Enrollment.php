<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'course_id',
        'student_id'
    ];

    /**
     * Get the course associated with the enrollment.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the student associated with the enrollment.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the attendances associated with the enrollment.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}

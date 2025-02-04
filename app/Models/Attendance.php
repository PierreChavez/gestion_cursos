<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'course_id',
        'student_id',
        'date',
        'present'
    ];
}

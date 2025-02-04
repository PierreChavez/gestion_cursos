<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'course_id',
        'student_id',
        'certificate_url'
    ];
}

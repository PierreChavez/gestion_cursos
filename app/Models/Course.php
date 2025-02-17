<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'modality',
        'start_date',
        'end_date',
        'teacher_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }


    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function courseModule()
    {
        return $this->belongsTo(CourseModule::class);
    }
}

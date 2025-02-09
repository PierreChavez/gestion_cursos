<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'enrollment_id',
        'date',
        'status',
        'comments'
    ];

    /**
     * Get the enrollment associated with the attendance.
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}

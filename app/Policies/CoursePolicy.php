<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * Determine whether the user can create courses.
     */
    public function create(User $user): Response
    {
        return $user->hasAnyRole(['admin', 'teacher'])
            ? Response::allow()
            : Response::deny('You do not have permission to create courses.');
    }

    /**
     * Determine whether the user can assign courses.
     */
    public function assign(User $user): Response
    {
        return $user->hasAnyRole(['admin', 'teacher'])
            ? Response::allow()
            : Response::deny('You do not have permission to assign courses.');
    }
}

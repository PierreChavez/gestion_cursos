<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('role:admin|teacher'),
        ];
    }

    public function index()
    {
        $enrollments = Enrollment::all();
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $courses = Course::all();
        } elseif ($user->hasRole('teacher')) {
            $courses = $user->courses;
        } else {
            abort(403, 'Unauthorized action.');
        }

        $students = User::role('student')->get();

        return view('enrollments.create', compact('courses', 'students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:users,id'
        ]);

        Enrollment::create($validated);

        return redirect()->route('enrollments.index');
    }

    public function show(Enrollment $enrollment)
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $courses = Course::all();
        } elseif ($user->hasRole('teacher')) {
            $courses = $user->courses;
        } else {
            abort(403, 'Unauthorized action.');
        }

        $students = User::role('student')->get();

        return view('enrollments.show', compact('enrollment', 'courses', 'students'));
    }

    public function edit(Enrollment $enrollment)
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $courses = Course::all();
        } elseif ($user->hasRole('teacher')) {
            $courses = $user->courses;
        } else {
            abort(403, 'Unauthorized action.');
        }

        $students = User::role('student')->get();

        return view('enrollments.edit', compact('enrollment', 'courses', 'students'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:users,id'
        ]);

        $enrollment->update($validated);

        return redirect()->route('enrollments.index');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index');
    }
}

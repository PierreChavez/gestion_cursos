<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('role:admin|teacher'),
        ];
    }


    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('admin') || $user->hasRole('teacher')) {
            $courses = Course::with('teacher')->get();
        } else {
            $courses = $user->courses;
        }
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        Gate::authorize('create', Course::class);
        $teachers = User::role('teacher')->get();
        return view('courses.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Course::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'modality' => 'required|string',
            'teacher_id' => 'required|exists:users,id',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index');
    }

    public function show(Course $course)
    {
        $course->load('teacher', 'resources');
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $date = now()->format('Y-m-d');
        $teachers = User::role('teacher')->get();
        $course->load('resources', 'teacher');
        $enrollments = Enrollment::with(['student', 'attendances' => function($query) use ($date) {
            $query->where('date', $date);
        }])->where('course_id', $course->id)->get();
        return view('courses.edit', compact('course', 'teachers', 'enrollments'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $course->update($validated);

        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index');
    }
}

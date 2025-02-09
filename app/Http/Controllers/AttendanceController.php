<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $courses = Course::all();
        } else {
            $courses = Course::where('teacher_id', $user->id)->get();
        }
        $attendances = Attendance::with('enrollment.student', 'enrollment.course')->get();
        return view('attendances.index', compact('attendances', 'courses'));
    }

    public function create()
    {
        $enrollments = Enrollment::with('student', 'course')->get();
        return view('attendances.create', compact('enrollments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'date' => 'required|date',
            'status' => 'required|string',
            'comments' => 'nullable|string'
        ]);

        Attendance::create($validated);

        if ($request->has('redirect_to_sheet')) {
            return redirect()->route('attendances.sheet', [
                'course_id' => $request->input('course_id'),
                'date' => $request->input('date')
            ]);
        }

        return redirect()->route('attendances.index');
    }

    public function show(Attendance $attendance)
    {
        $enrollments = Enrollment::with('student', 'course')->get();
        $attendance->load('enrollment.student', 'enrollment.course');
        return view('attendances.show', compact('attendance', 'enrollments'));
    }

    public function edit(Attendance $attendance)
    {
        $attendance->load('enrollment.student', 'enrollment.course');
        $enrollments = Enrollment::with('student', 'course')->get();
        return view('attendances.edit', compact('attendance', 'enrollments'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'date' => 'required|date',
            'status' => 'required|string',
            'comments' => 'nullable|string'
        ]);

        $attendance->update($validated);

        return redirect()->route('attendances.index');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index');
    }

    public function attendanceSheet(Request $request)
    {
        $course_id = $request->input('course_id');
        $date = $request->input('date');

        $course = Course::findOrFail($course_id);
        $enrollments = Enrollment::with(['student', 'attendances' => function($query) use ($date) {
            $query->where('date', $date);
        }])->where('course_id', $course_id)->get();

        return view('attendances.sheet', compact('course', 'enrollments', 'date'));
    }
}

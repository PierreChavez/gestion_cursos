<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('enrollment.student', 'enrollment.course')->get();
        return view('attendances.index', compact('attendances'));
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
}

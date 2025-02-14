<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();
        return view('certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('certificates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'issued_at' => 'required|date',
            'certificate_path' => 'required|string'
        ]);

        Certificate::create($validated);

        return redirect()->route('certificates.index');
    }

    public function show(Certificate $certificate)
    {
        return view('certificates.show', compact('certificate'));
    }

    public function edit(Certificate $certificate)
    {
        return view('certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'issued_at' => 'required|date',
            'certificate_path' => 'required|string'
        ]);

        $certificate->update($validated);

        return redirect()->route('certificates.index');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()->route('certificates.index');
    }

    public function generateCertificate(Request $request, $studentId, $courseId)
    {
        $student = Student::findOrFail($studentId);
        $course = Course::findOrFail($courseId);

        $grade = Grade::where('student_id', $studentId)->where('course_id', $courseId)->first();
        $attendance = Attendance::where('student_id', $studentId)->where('course_id', $courseId)->first();

        $minGrade = config('app.min_grade', 70);
        $minAttendance = config('app.min_attendance', 75);

        if ($grade->grade >= $minGrade && ($attendance->attended_classes / $attendance->total_classes) * 100 >= $minAttendance) {
            $pdf = PDF::loadView('certificates.certificate', compact('student', 'course', 'grade', 'attendance'));
            $path = 'certificates/' . $student->id . '_' . $course->id . '.pdf';
            $pdf->save(storage_path('app/public/' . $path));

            Certificate::create([
                'student_id' => $studentId,
                'course_id' => $courseId,
                'certificate_path' => $path,
            ]);

            return response()->download(storage_path('app/public/' . $path));
        }

        return response()->json(['message' => 'Student does not meet the requirements for a certificate.'], 400);
    }
}

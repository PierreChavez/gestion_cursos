<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\CourseModule;
use App\Models\User;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with('courseModule', 'student')->get();
        return view('grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courseModules = CourseModule::all();
        $students = User::role('student')->get();
        return view('grades.create', compact('courseModules', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_module_id' => 'required|exists:course_modules,id',
            'student_id' => 'required|exists:users,id',
            'grade' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
        ]);

        Grade::create($validated);
        return redirect()->route('grades.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        return view('grades.show', compact('grade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        $courseModules = CourseModule::all();
        $students = User::role('student')->get();
        return view('grades.edit', compact('grade', 'courseModules', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        $validated = $request->validate([
            'course_module_id' => 'required|exists:course_modules,id',
            'student_id' => 'required|exists:users,id',
            'grade' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
        ]);

        $grade->update($validated);
        return redirect()->route('grades.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index');
    }
}

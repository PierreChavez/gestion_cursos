<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseModule;

class CourseModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = CourseModule::with('course')->get();
        return view('course_modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('course_modules.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'description' => 'nullable|string',
            'type' => 'required|in:lesson,exam',
        ]);

        CourseModule::create($validated);
        return redirect()->route('course_modules.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseModule $courseModule)
    {
        return view('course_modules.show', compact('courseModule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseModule $courseModule)
    {
        $courses = Course::all();
        return view('course_modules.edit', compact('courseModule', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseModule $courseModule)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'description' => 'nullable|string',
            'type' => 'required|in:lesson,exam',
        ]);

        $courseModule->update($validated);
        return redirect()->route('course_modules.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseModule $courseModule)
    {
        $courseModule->delete();
        return redirect()->route('course_modules.index');
    }
}

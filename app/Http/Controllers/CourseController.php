<?php

    namespace App\Http\Controllers;

    use App\Models\Course;
    use Illuminate\Http\Request;

    class CourseController extends Controller
    {
        public function index()
        {
            $courses = Course::all();
            return view('courses.index', compact('courses'));
        }

        public function create()
        {
            return view('courses.create');
        }

        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'duration' => 'required|string',
                'modality' => 'required|string',
                'teacher_id' => 'required|exists:users,id',
            ]);

            Course::create($validated);

            return redirect()->route('courses.index');
        }

        public function show(Course $course)
        {
            return view('courses.show', compact('course'));
        }

        public function edit(Course $course)
        {
            return view('courses.edit', compact('course'));
        }

        public function update(Request $request, Course $course)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'duration' => 'required|string',
                'modality' => 'required|string',
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

<?php

    namespace App\Http\Controllers;

    use App\Models\Course;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Routing\Controllers\HasMiddleware;
    use Illuminate\Routing\Controllers\Middleware;

    class CourseController extends Controller implements HasMiddleware
    {

        public static function middleware(): array
        {
            return [
                new Middleware('role:admin|teacher', only: ['index', 'show']),
                //new Middleware('role:student', only: ['index', 'show']),
            ];
        }


        public function index()
        {
            $user = Auth::user();
            if ($user->hasRole('admin') || $user->hasRole('teacher')) {
                $courses = Course::all();
            } else {
                $courses = $user->courses;
            }
            return view('courses.index', compact('courses'));
        }

        public function create()
        {
            $this->authorize('create', Course::class);
            return view('courses.create');
        }

        public function store(Request $request)
        {
            $this->authorize('create', Course::class);

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

<?php

    namespace App\Http\Controllers;

    use App\Models\Attendance;
    use Illuminate\Http\Request;

    class AttendanceController extends Controller
    {
        public function index()
        {
            $attendances = Attendance::all();
            return view('attendances.index', compact('attendances'));
        }

        public function create()
        {
            return view('attendances.create');
        }

        public function store(Request $request)
        {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'course_id' => 'required|exists:courses,id',
                'date' => 'required|date',
                'status' => 'required|string'
            ]);

            Attendance::create($validated);

            return redirect()->route('attendances.index');
        }

        public function show(Attendance $attendance)
        {
            return view('attendances.show', compact('attendance'));
        }

        public function edit(Attendance $attendance)
        {
            return view('attendances.edit', compact('attendance'));
        }

        public function update(Request $request, Attendance $attendance)
        {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'course_id' => 'required|exists:courses,id',
                'date' => 'required|date',
                'status' => 'required|string'
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

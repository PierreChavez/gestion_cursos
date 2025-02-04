<?php

     namespace App\Http\Controllers;

     use App\Models\Enrollment;
     use Illuminate\Http\Request;

     class EnrollmentController extends Controller
     {
         public function index()
         {
             $enrollments = Enrollment::all();
             return view('enrollments.index', compact('enrollments'));
         }

         public function create()
         {
             return view('enrollments.create');
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
             return view('enrollments.show', compact('enrollment'));
         }

         public function edit(Enrollment $enrollment)
         {
             return view('enrollments.edit', compact('enrollment'));
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

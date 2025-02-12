<?php

    namespace App\Http\Controllers;

    use App\Models\Course;
    use App\Models\Resource;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;

    class ResourceController extends Controller
    {
        public function index()
        {
            $resources = Resource::all();
            return view('resources.index', compact('resources'));
        }

        public function create()
        {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                $courses = Course::all();
            } elseif ($user->hasRole('teacher')) {
                $courses = $user->courses;
            } else {
                abort(403, 'Unauthorized action.');
            }

            return view('resources.create', compact('courses', ));
        }

        public function store(Request $request)
        {
            $request->validate([
                'course_id' => 'required|exists:courses,id',
                'type' => 'required|string',
                'description' => 'nullable|string',
                'file' => 'required|file|mimes:jpg,jpeg,png,mp4,avi,doc,docx,pdf'
            ]);


            $file = $request->file('file');
            $filePath = 'uploads/' . time() . '_' . $file->getClientOriginalName();
            Storage::disk('spaces')->put($filePath, fopen($file, 'r+'), 'public');
            $url = Storage::disk('spaces')->url($filePath);

            Resource::create([
                'course_id' => $request->course_id,
                'type' => $request->type,
                'url' => $url,
                'description' => $request->description
            ]);

            return redirect()->route('resources.index')->with('success', 'Resource created successfully.');
        }

        public function show(Resource $resource)
        {
            return view('resources.show', compact('resource'));
        }

        public function edit(Resource $resource)
        {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                $courses = Course::all();
            } elseif ($user->hasRole('teacher')) {
                $courses = $user->courses;
            } else {
                abort(403, 'Unauthorized action.');
            }
            return view('resources.edit', compact('resource', 'courses'));
        }

        public function update(Request $request, Resource $resource)
        {
            $request->validate([
                'course_id' => 'required|exists:courses,id',
                'type' => 'required|string',
                'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,doc,docx,pdf'
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filePath = 'uploads/' . time() . '_' . $file->getClientOriginalName();
                Storage::disk('spaces')->put($filePath, fopen($file, 'r+'), 'public');
                $url = Storage::disk('spaces')->url($filePath);
                $resource->url = $url;
            }

            $resource->type = $request->type;
            $resource->description = $request->description;
            $resource->save();

            return redirect()->route('resources.index')->with('success', 'Resource updated successfully.');

        }

        public function destroy(Resource $resource)
        {
            $resource->delete();

            return redirect()->route('resources.index')->with('success', 'Resource deleted successfully.');
        }
    }

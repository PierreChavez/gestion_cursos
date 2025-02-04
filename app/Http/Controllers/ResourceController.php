<?php

    namespace App\Http\Controllers;

    use App\Models\Resource;
    use Illuminate\Http\Request;

    class ResourceController extends Controller
    {
        public function index()
        {
            $resources = Resource::all();
            return view('resources.index', compact('resources'));
        }

        public function create()
        {
            return view('resources.create');
        }

        public function store(Request $request)
        {
            $validated = $request->validate([
                'course_id' => 'required|exists:courses,id',
                'type' => 'required|string',
                'url' => 'required|string'
            ]);

            Resource::create($validated);

            return redirect()->route('resources.index');
        }

        public function show(Resource $resource)
        {
            return view('resources.show', compact('resource'));
        }

        public function edit(Resource $resource)
        {
            return view('resources.edit', compact('resource'));
        }

        public function update(Request $request, Resource $resource)
        {
            $validated = $request->validate([
                'course_id' => 'required|exists:courses,id',
                'type' => 'required|string',
                'url' => 'required|string'
            ]);

            $resource->update($validated);

            return redirect()->route('resources.index');
        }

        public function destroy(Resource $resource)
        {
            $resource->delete();

            return redirect()->route('resources.index');
        }
    }

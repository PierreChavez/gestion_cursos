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
}

<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseModuleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('courses', CourseController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::get('attendances/sheet', [AttendanceController::class, 'attendanceSheet'])->name('attendances.sheet');
    Route::resource('attendances', AttendanceController::class)->middleware('handle.return_url');
    Route::resource('resources', ResourceController::class)->middleware('handle.return_url');
    Route::resource('certificates', CertificateController::class);
    Route::resource('users', UserController::class)->middleware('role:admin');
    Route::resource('course_modules', CourseModuleController::class);
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\Admin\ExerciseController;
use App\Http\Controllers\Admin\RoutineController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentRoutineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\WorkoutLogController;
use Illuminate\Support\Facades\Route;

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
});

require __DIR__ . '/auth.php';

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin']);

Route::get('/student', function () {
    $student = auth()->user()->load('routines.exercises');

    return view('student.dashboard', compact('student'));
})->middleware(['auth', 'role:student']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/students', [StudentController::class, 'index']);
    Route::resource('/admin/exercises', ExerciseController::class)->except(['show']);
    Route::resource('/admin/routines', RoutineController::class)->except(['show']);

    Route::get('/admin/assign-routine', [StudentRoutineController::class, 'create']);
    Route::post('/admin/assign-routine', [StudentRoutineController::class, 'store']);
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/workouts', [WorkoutLogController::class, 'index']);
    Route::get('/student/workouts/create', [WorkoutLogController::class, 'create']);
    Route::post('/student/workouts', [WorkoutLogController::class, 'store']);
    Route::get('/student/progress', [WorkoutLogController::class, 'progress']);
});

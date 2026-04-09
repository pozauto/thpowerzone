<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\WorkoutLog;
use Illuminate\Http\Request;

class WorkoutLogController extends Controller
{
    public function index()
    {
        $logs = WorkoutLog::with('exercise')
            ->where('user_id', auth()->id())
            ->orderBy('performed_at', 'desc')
            ->get();

        return view('student.workouts.index', compact('logs'));
    }

    public function create()
    {
        $exercises = auth()->user()
            ->routines
            ->flatMap->exercises
            ->unique('id');

        return view('student.workouts.create', compact('exercises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exercise_id' => 'required|exists:exercises,id',
            'reps' => 'required|integer',
            'weight' => 'required|numeric',
            'performed_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        WorkoutLog::create([
            'user_id' => auth()->id(),
            'exercise_id' => $request->exercise_id,
            'reps' => $request->reps,
            'weight' => $request->weight,
            'notes' => $request->notes,
            'performed_at' => $request->performed_at,
        ]);

        return redirect('/student/workouts')->with('success', 'Entrenamiento guardado correctamente');
    }

    public function progress()
    {
        $logs = WorkoutLog::with('exercise')
            ->where('user_id', auth()->id())
            ->orderBy('performed_at')
            ->get()
            ->groupBy(function ($log) {
                return $log->exercise->name;
            });

        return view('student.progress', compact('logs'));
    }
}

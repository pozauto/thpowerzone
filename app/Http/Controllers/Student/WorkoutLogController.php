<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\WorkoutLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutLogController extends Controller
{
    public function index()
    {
        $logs = WorkoutLog::with('exercise')
            ->where('user_id', Auth::id())
            ->orderBy('performed_at', 'desc')
            ->get();

        return view('student.workouts.index', compact('logs'));
    }

    public function create()
    {
        $user = Auth::user();

        $exercises = $user->routines
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
            'user_id' => Auth::id(),
            'exercise_id' => $request->exercise_id,
            'reps' => $request->reps,
            'weight' => $request->weight,
            'notes' => $request->notes,
            'performed_at' => $request->performed_at,
        ]);

        return redirect('/student/workouts')->with('success', 'Entrenamiento guardado correctamente');
    }

    public function edit(WorkoutLog $workoutLog)
    {
        if ($workoutLog->user_id !== Auth::id()) {
            abort(403);
        }

        $user = Auth::user();

        $exercises = $user->routines
            ->flatMap->exercises
            ->unique('id');

        return view('student.workouts.edit', compact('workoutLog', 'exercises'));
    }

    public function update(Request $request, WorkoutLog $workoutLog)
    {
        if ($workoutLog->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'exercise_id' => 'required|exists:exercises,id',
            'reps' => 'required|integer',
            'weight' => 'required|numeric',
            'performed_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $workoutLog->update([
            'exercise_id' => $request->exercise_id,
            'reps' => $request->reps,
            'weight' => $request->weight,
            'notes' => $request->notes,
            'performed_at' => $request->performed_at,
        ]);

        return redirect('/student/workouts')->with('success', 'Entrenamiento actualizado correctamente');
    }

    public function destroy(WorkoutLog $workoutLog)
    {
        if ($workoutLog->user_id !== Auth::id()) {
            abort(403);
        }

        $workoutLog->delete();

        return redirect('/student/workouts')->with('success', 'Entrenamiento eliminado correctamente');
    }

    public function progress(Request $request)
    {
        $user = Auth::user();
        $exerciseId = $request->query('exercise_id');

        $exercises = $user->routines
            ->flatMap->exercises
            ->unique('id');

        $logsQuery = WorkoutLog::with('exercise')
            ->where('user_id', $user->id);

        if ($exerciseId) {
            $logsQuery->where('exercise_id', $exerciseId);
        }

        $logs = $logsQuery
            ->orderBy('performed_at')
            ->get();

        return view('student.progress', compact('logs', 'exercises', 'exerciseId'));
    }
}

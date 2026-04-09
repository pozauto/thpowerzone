<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Routine;
use App\Models\User;
use Illuminate\Http\Request;

class StudentRoutineController extends Controller
{
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $routines = Routine::all();

        return view('admin.assignments.create', compact('students', 'routines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'routine_id' => 'required|exists:routines,id',
        ]);

        $student = User::findOrFail($request->student_id);
        $student->routines()->sync([$request->routine_id]);

        return redirect('/admin')->with('success', 'Rutina asignada correctamente');
    }
}

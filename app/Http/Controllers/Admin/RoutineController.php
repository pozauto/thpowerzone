<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Routine;
use App\Models\Exercise;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    public function index()
    {
        $routines = Routine::with('exercises')->get();
        return view('admin.routines.index', compact('routines'));
    }

    public function create()
    {
        $exercises = Exercise::all();
        return view('admin.routines.create', compact('exercises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'exercises' => 'nullable|array',
            'exercises.*' => 'exists:exercises,id',
        ]);

        $routine = Routine::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $routine->exercises()->sync($request->exercises ?? []);

        return redirect('/admin/routines')->with('success', 'Rutina creada correctamente');
    }

    public function edit(Routine $routine)
    {
        $exercises = Exercise::all();
        $selectedExercises = $routine->exercises->pluck('id')->toArray();

        return view('admin.routines.edit', compact('routine', 'exercises', 'selectedExercises'));
    }

    public function update(Request $request, Routine $routine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'exercises' => 'nullable|array',
            'exercises.*' => 'exists:exercises,id',
        ]);

        $routine->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $routine->exercises()->sync($request->exercises ?? []);

        return redirect('/admin/routines')->with('success', 'Rutina actualizada correctamente');
    }

    public function destroy(Routine $routine)
    {
        $routine->exercises()->detach();
        $routine->delete();

        return redirect('/admin/routines')->with('success', 'Rutina eliminada correctamente');
    }
}

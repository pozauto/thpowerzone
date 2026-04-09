<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::all();
        return view('admin.exercises.index', compact('exercises'));
    }

    public function create()
    {
        return view('admin.exercises.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'muscle_group' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Exercise::create($request->all());

        return redirect('/admin/exercises')->with('success', 'Ejercicio creado');
    }

    public function edit(Exercise $exercise)
    {
        return view('admin.exercises.edit', compact('exercise'));
    }

    public function update(Request $request, Exercise $exercise)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'muscle_group' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $exercise->update($request->all());

        return redirect('/admin/exercises')->with('success', 'Ejercicio actualizado');
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return redirect('/admin/exercises')->with('success', 'Ejercicio eliminado');
    }
}

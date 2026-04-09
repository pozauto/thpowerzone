<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar entrenamiento
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="/student/workouts/{{ $workoutLog->id }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Ejercicio</label><br>
                <select name="exercise_id" class="border p-2 w-full">
                    @foreach($exercises as $exercise)
                        <option value="{{ $exercise->id }}" {{ $workoutLog->exercise_id == $exercise->id ? 'selected' : '' }}>
                            {{ $exercise->name }} ({{ $exercise->muscle_group }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Repeticiones</label><br>
                <input type="number" name="reps" value="{{ $workoutLog->reps }}" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Peso</label><br>
                <input type="number" step="0.1" name="weight" value="{{ $workoutLog->weight }}" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Fecha</label><br>
                <input type="date" name="performed_at" value="{{ $workoutLog->performed_at }}" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Notas</label><br>
                <textarea name="notes" class="border p-2 w-full">{{ $workoutLog->notes }}</textarea>
            </div>

            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Actualizar entrenamiento
            </button>
        </form>
    </div>
</x-app-layout>

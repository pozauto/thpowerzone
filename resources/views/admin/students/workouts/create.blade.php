<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar entrenamiento
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="/student/workouts">
            @csrf

            <div class="mb-4">
                <label>Ejercicio</label><br>
                <select name="exercise_id" class="border p-2 w-full">
                    @foreach($exercises as $exercise)
                        <option value="{{ $exercise->id }}">
                            {{ $exercise->name }} ({{ $exercise->muscle_group }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Repeticiones</label><br>
                <input type="number" name="reps" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Peso</label><br>
                <input type="number" step="0.1" name="weight" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Fecha</label><br>
                <input type="date" name="performed_at" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Notas</label><br>
                <textarea name="notes" class="border p-2 w-full"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Guardar entrenamiento
            </button>
        </form>
    </div>
</x-app-layout>

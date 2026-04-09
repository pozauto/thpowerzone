<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel del Alumno
        </h2>
    </x-slot>

    <div class="p-6">

        {{-- BOTONES --}}
        <div  class="mb-6">
    <a href="/student/workouts" class="bg-blue-500 text-white px-4 py-2 rounded">
        Ver historial
    </a>

    <a href="/student/workouts/create" class="bg-green-500 text-white px-4 py-2 rounded ml-2">
        Registrar entrenamiento
    </a>

    <a href="/student/progress" class="bg-purple-500 text-white px-4 py-2 rounded ml-2">
        Ver progreso
    </a>
        </div>

        <h3 class="text-lg font-bold mb-4">Tu rutina asignada</h3>

        @if($student->routines->count() > 0)

            @foreach($student->routines as $routine)
                <div class="mb-6 p-4 border rounded bg-white">

                    <h4 class="text-xl font-semibold">
                        {{ $routine->name }}
                    </h4>

                    <p class="mb-3 text-gray-600">
                        {{ $routine->description }}
                    </p>

                    <h5 class="font-bold">Ejercicios:</h5>

                    <ul class="list-disc ml-6 mt-2">
                        @foreach($routine->exercises as $exercise)
                            <li>
                                {{ $exercise->name }} ({{ $exercise->muscle_group }})
                            </li>
                        @endforeach
                    </ul>

                </div>
            @endforeach

        @else
            <p>No tienes ninguna rutina asignada todavía.</p>
        @endif

    </div>
</x-app-layout>
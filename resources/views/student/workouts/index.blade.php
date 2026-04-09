<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Historial de entrenamientos
        </h2>
    </x-slot>

    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="/student/workouts/create" class="bg-blue-500 text-white px-4 py-2 rounded">
                Registrar nuevo entrenamiento
            </a>
        </div>

        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Fecha</th>
                    <th class="border px-4 py-2">Ejercicio</th>
                    <th class="border px-4 py-2">Repeticiones</th>
                    <th class="border px-4 py-2">Peso</th>
                    <th class="border px-4 py-2">Notas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td class="border px-4 py-2">{{ $log->performed_at }}</td>
                        <td class="border px-4 py-2">{{ $log->exercise->name }}</td>
                        <td class="border px-4 py-2">{{ $log->reps }}</td>
                        <td class="border px-4 py-2">{{ $log->weight }}</td>
                        <td class="border px-4 py-2">{{ $log->notes }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center">
                            Todavía no has registrado entrenamientos.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>

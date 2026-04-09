<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Progreso de entrenamiento
        </h2>
    </x-slot>

    <div class="p-6">

        {{-- SELECTOR DE EJERCICIO --}}
        <form method="GET" class="mb-6">
            <label class="font-bold">Selecciona ejercicio:</label>
            <select name="exercise_id" onchange="this.form.submit()" class="border p-2 ml-2">
                <option value="">-- Todos --</option>

                @foreach($exercises as $exercise)
                    <option value="{{ $exercise->id }}"
                        {{ $exerciseId == $exercise->id ? 'selected' : '' }}>
                        {{ $exercise->name }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- GRÁFICA --}}
        @if($logs->count() > 0)
            <canvas id="progressChart"></canvas>
        @else
            <p>No hay datos para mostrar.</p>
        @endif

        {{-- TABLA --}}
        @if($logs->count() > 0)
            <table class="w-full border mt-8">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Fecha</th>
                        <th class="border px-4 py-2">Ejercicio</th>
                        <th class="border px-4 py-2">Reps</th>
                        <th class="border px-4 py-2">Peso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td class="border px-4 py-2">{{ $log->performed_at }}</td>
                            <td class="border px-4 py-2">{{ $log->exercise->name }}</td>
                            <td class="border px-4 py-2">{{ $log->reps }}</td>
                            <td class="border px-4 py-2">{{ $log->weight }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = {!! json_encode($logs->pluck('performed_at')) !!};
        const data = {!! json_encode($logs->pluck('weight')) !!};

        new Chart(document.getElementById('progressChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Peso',
                    data: data,
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                }]
            }
        });
    </script>
</x-app-layout>

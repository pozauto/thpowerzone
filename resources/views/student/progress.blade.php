@php use Illuminate\Support\Str; @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Progreso de entrenamiento
        </h2>
    </x-slot>

    <div class="p-6">
        @if($logs->count() > 0)
            @foreach($logs as $exerciseName => $exerciseLogs)
                <div class="mb-10">
                    <h3 class="text-lg font-bold mb-4">{{ $exerciseName }}</h3>
                    <canvas id="chart-{{ Str::slug($exerciseName) }}"></canvas>
                </div>
            @endforeach
        @else
            <p>No hay datos de progreso todavía.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        @foreach($logs as $exerciseName => $exerciseLogs)
            new Chart(document.getElementById('chart-{{ Str::slug($exerciseName) }}'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($exerciseLogs->pluck('performed_at')->values()) !!},
                    datasets: [{
                        label: 'Peso',
                        data: {!! json_encode($exerciseLogs->pluck('weight')->values()) !!},
                        borderWidth: 2,
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        @endforeach
    </script>
</x-app-layout>

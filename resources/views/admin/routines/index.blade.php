<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Rutinas</h2>
    </x-slot>

    <div class="p-6">
        <a href="/admin/routines/create" class="bg-blue-500 text-white px-4 py-2 rounded">
            Nueva rutina
        </a>

        @if(session('success'))
            <div class="mt-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <table class="mt-4 w-full border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Ejercicios</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($routines as $routine)
                    <tr>
                        <td>{{ $routine->id }}</td>
                        <td>{{ $routine->name }}</td>
                        <td>{{ $routine->description }}</td>
                        <td>
                            @foreach($routine->exercises as $exercise)
                                <span>{{ $exercise->name }}</span><br>
                            @endforeach
                        </td>
                        <td>
                            <a href="/admin/routines/{{ $routine->id }}/edit">Editar</a>

                            <form action="/admin/routines/{{ $routine->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

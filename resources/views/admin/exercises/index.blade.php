<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Ejercicios</h2>
    </x-slot>

    <div class="p-6">
        <a href="/admin/exercises/create" class="bg-blue-500 text-white px-4 py-2 rounded">
            Nuevo ejercicio
        </a>

        <table class="mt-4 w-full border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Grupo muscular</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($exercises as $exercise)
                    <tr>
                        <td>{{ $exercise->id }}</td>
                        <td>{{ $exercise->name }}</td>
                        <td>{{ $exercise->muscle_group }}</td>
                        <td>
                            <a href="/admin/exercises/{{ $exercise->id }}/edit">Editar</a>

                            <form action="/admin/exercises/{{ $exercise->id }}" method="POST" style="display:inline;">
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

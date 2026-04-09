<x-app-layout>
    <x-slot name="header">
        <h2>Editar rutina</h2>
    </x-slot>

    <div class="p-6">
        <form action="/admin/routines/{{ $routine->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Nombre</label><br>
                <input type="text" name="name" value="{{ $routine->name }}" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Descripción</label><br>
                <textarea name="description" class="border p-2 w-full">{{ $routine->description }}</textarea>
            </div>

            <div class="mb-4">
                <label>Ejercicios</label><br>
                @foreach($exercises as $exercise)
                    <div>
                        <label>
                            <input
                                type="checkbox"
                                name="exercises[]"
                                value="{{ $exercise->id }}"
                                {{ in_array($exercise->id, $selectedExercises) ? 'checked' : '' }}
                            >
                            {{ $exercise->name }} ({{ $exercise->muscle_group }})
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Actualizar rutina
            </button>
        </form>
    </div>
</x-app-layout>

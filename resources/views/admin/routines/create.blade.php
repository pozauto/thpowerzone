<x-app-layout>
    <x-slot name="header">
        <h2>Crear rutina</h2>
    </x-slot>

    <div class="p-6">
        <form action="/admin/routines" method="POST">
            @csrf

            <div class="mb-4">
                <label>Nombre</label><br>
                <input type="text" name="name" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Descripción</label><br>
                <textarea name="description" class="border p-2 w-full"></textarea>
            </div>

            <div class="mb-4">
                <label>Ejercicios</label><br>
                @foreach($exercises as $exercise)
                    <div>
                        <label>
                            <input type="checkbox" name="exercises[]" value="{{ $exercise->id }}">
                            {{ $exercise->name }} ({{ $exercise->muscle_group }})
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                Guardar rutina
            </button>
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2>Editar ejercicio</h2>
    </x-slot>

    <div class="p-6">
        <form action="/admin/exercises/{{ $exercise->id }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $exercise->name }}"><br><br>
            <input type="text" name="muscle_group" value="{{ $exercise->muscle_group }}"><br><br>
            <textarea name="description">{{ $exercise->description }}</textarea><br><br>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</x-app-layout>

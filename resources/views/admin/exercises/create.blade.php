<x-app-layout>
    <x-slot name="header">
        <h2>Crear ejercicio</h2>
    </x-slot>

    <div class="p-6">
        <form action="/admin/exercises" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Nombre"><br><br>
            <input type="text" name="muscle_group" placeholder="Grupo muscular"><br><br>
            <textarea name="description" placeholder="Descripción"></textarea><br><br>

            <button type="submit">Guardar</button>
        </form>
    </div>
</x-app-layout>

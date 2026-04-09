<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel del Entrenador
        </h2>
    </x-slot>

    <div class="p-6">
        <h3 class="text-lg font-bold">Bienvenido entrenador</h3>

        <div class="mt-4 space-x-2">
            <a href="/admin/students" class="bg-blue-500 text-white px-4 py-2 rounded">
                Ver alumnos
            </a>

            <a href="/admin/assign-routine" class="bg-green-500 text-white px-4 py-2 rounded">
                Asignar rutina
            </a>

            <a href="/admin/exercises" class="bg-purple-500 text-white px-4 py-2 rounded">
                Gestionar ejercicios
            </a>

            <a href="/admin/routines" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Gestionar rutinas
            </a>
        </div>
    </div>
</x-app-layout>

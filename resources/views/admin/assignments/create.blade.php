<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Asignar rutina a alumno</h2>
    </x-slot>

    <div class="p-6">
        <form action="/admin/assign-routine" method="POST">
            @csrf

            <div class="mb-4">
                <label>Alumno</label><br>
                <select name="student_id" class="border p-2 w-full">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->email }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Rutina</label><br>
                <select name="routine_id" class="border p-2 w-full">
                    @foreach($routines as $routine)
                        <option value="{{ $routine->id }}">{{ $routine->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                Asignar rutina
            </button>
        </form>
    </div>
</x-app-layout>
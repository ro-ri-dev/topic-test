<x-app-layout>
    <x-slot name="header">
        <h2>Crear pregunta · {{ $topic->name }}</h2>
    </x-slot>

    <div class="p-6">

       <form method="POST" action="{{ route('admin.questions.store', $topic) }}">
            @csrf

            <!-- Texto de la pregunta -->
            <div class="mb-4">
                <label class="block mb-1">Texto de la pregunta</label>
                <input type="text" name="question" class="border p-2 w-full" required>
            </div>

            <!-- Respuestas -->
            <div class="mb-2">
                <label>Respuesta 1</label>
                <input type="text" name="answers[]" class="border p-2 w-full" required>
                <label>
                    <input type="radio" name="correct" value="0" required>
                    Correcta
                </label>
            </div>

            <div class="mb-2">
                <label>Respuesta 2</label>
                <input type="text" name="answers[]" class="border p-2 w-full" required>
                <label>
                    <input type="radio" name="correct" value="1">
                    Correcta
                </label>
            </div>

            <div class="mb-2">
                <label>Respuesta 3</label>
                <input type="text" name="answers[]" class="border p-2 w-full" required>
                <label>
                    <input type="radio" name="correct" value="2">
                    Correcta
                </label>
            </div>

            <div class="mb-4">
                <label>Respuesta 4</label>
                <input type="text" name="answers[]" class="border p-2 w-full" required>
                <label>
                    <input type="radio" name="correct" value="3">
                    Correcta
                </label>
            </div>

<button type="submit"
    style="background-color:gray;color:#ffffff;border:2px solid darkgray;padding:8px 16px;border-radius:6px;cursor:pointer;">
    Guardar pregunta
</button>

        </form>

    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Pregunta
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 border rounded">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.questions.update', $question) }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block mb-1">Pregunta</label>
                <input name="question" value="{{ old('question', $question->question) }}" class="border rounded w-full p-2">
                @error('question') <div class="text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">Respuesta</label>
                <input name="answer" value="{{ old('answer', $question->answer) }}" class="border rounded w-full p-2">
                @error('answer') <div class="text-sm">{{ $message }}</div> @enderror
            </div>

            <button class="border rounded px-4 py-2">Guardar cambios</button>
            <a class="ml-2 underline" href="{{ route('admin.questions.index', $question->topic_id) }}">Volver</a>
        </form>
    </div>
</x-app-layout>

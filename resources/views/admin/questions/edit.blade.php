<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar pregunta
        </h2>
    </x-slot>
<div class="px-6 pt-2 text-sm text-gray-600">
    Topic: {{ $question->topic->name }}
</div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
<div class="mb-6">
    <form method="POST" action="{{ route('admin.questions.update', $question) }}">
    @csrf
    @method('PATCH')
    <div class="mb-6">
    <label class="block font-semibold mb-2">Pregunta</label>

    <textarea name="question"
              class="border rounded w-full p-2"
              rows="3">{{ old('question', $question->text) }}</textarea>

    @error('question')
        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
    @enderror
</div>
    <div class="font-semibold mb-2">Respuestas (2…n) · marca la correcta</div>

    @error('answers_min') <div class="text-sm mb-2">{{ $message }}</div> @enderror
    @error('correct') <div class="text-sm mb-2">{{ $message }}</div> @enderror

    <div id="answers-list" class="space-y-3">
        @php
            $currentCorrectId = $question->answers->firstWhere('is_correct', true)?->id;
        @endphp

        @foreach($question->answers as $answer)
            <div class="answer-row flex items-center gap-3" data-existing-id="{{ $answer->id }}">
                <input type="radio"
                       name="correct"
                       value="a:{{ $answer->id }}"
                       @checked(old('correct', $currentCorrectId ? 'a:'.$currentCorrectId : null) === 'a:'.$answer->id)>

                <input name="answers_existing[{{ $answer->id }}][text]"
                       value="{{ old('answers_existing.' . $answer->id . '.text', $answer->text) }}"
                       class="border rounded w-full p-2">

<button type="button"
        class="underline text-sm text-red-600"
        data-action="delete-existing"
        data-answer-id="{{ $answer->id }}">
    Eliminar
</button>
            </div>

            @error('answers_existing.' . $answer->id . '.text')
                <div class="text-sm">{{ $message }}</div>
            @enderror
        @endforeach
    </div>

    <div class="mt-4 flex items-center gap-3">
        <button type="button" class="border rounded px-3 py-1" data-action="add-answer">
            + Añadir respuesta
        </button>
        <span class="text-sm text-gray-600">Mínimo 2 respuestas</span>
    </div>

    {{-- aquí se acumulan ids a borrar --}}
    <div id="answers-delete-container"></div>
        <div class="mt-6 flex items-center gap-3">
        <button type="submit" class="border rounded px-3 py-2">
            Guardar cambios
        </button>

        <a href="{{ route('admin.questions.index', $question->topic) }}" class="underline text-sm">
            Volver
        </a>
    </div>
</form>
</div>
  </div>
        </div>
    </div>
</x-app-layout>


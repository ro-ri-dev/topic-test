<div class="mb-6">
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
                        onclick="markDeleteExisting({{ $answer->id }})">
                    Eliminar
                </button>
            </div>

            @error('answers_existing.' . $answer->id . '.text')
                <div class="text-sm">{{ $message }}</div>
            @enderror
        @endforeach
    </div>

    <div class="mt-4 flex items-center gap-3">
        <button type="button" class="border rounded px-3 py-1" onclick="addNewAnswer()">
            + Añadir respuesta
        </button>
        <span class="text-sm text-gray-600">Mínimo 2 respuestas</span>
    </div>

    {{-- aquí se acumulan ids a borrar --}}
    <div id="answers-delete-container"></div>
</div>

<script>
    let newAnswerIndex = 0;

    function addNewAnswer() {
        const list = document.getElementById('answers-list');

        const row = document.createElement('div');
        row.className = 'answer-row flex items-center gap-3';
        row.dataset.newIndex = String(newAnswerIndex);

        row.innerHTML = `
            <input type="radio" name="correct" value="n:${newAnswerIndex}">
            <input name="answers_new[${newAnswerIndex}][text]" class="border rounded w-full p-2" placeholder="Nueva respuesta">
            <button type="button" class="underline text-sm text-red-600" onclick="removeNewAnswer(${newAnswerIndex})">Eliminar</button>
        `;

        list.appendChild(row);
        newAnswerIndex++;
    }

    function removeNewAnswer(idx) {
        const row = document.querySelector(\`.answer-row[data-new-index="\${idx}"]\`);
        if (row) row.remove();
    }

    function markDeleteExisting(id) {
        // añade un hidden input delete[] si no existe ya
        const container = document.getElementById('answers-delete-container');
        const existing = container.querySelector(\`input[name="answers_delete[]"][value="\${id}"]\`);
        if (!existing) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'answers_delete[]';
            input.value = String(id);
            container.appendChild(input);
        }

        // oculta la fila
        const row = document.querySelector(\`.answer-row[data-existing-id="\${id}"]\`);
        if (row) row.style.display = 'none';
    }
</script>

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Resultado · {{ $topic->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <p class="mb-6 font-bold">
                        Resultado: {{ $score }} / {{ count($results) }}
                    </p>

                    @foreach($results as $result)

                        <div class="mb-6">

                            <p class="font-semibold">
                                {{ $result['question']->text }}
                            </p>

                            <p class="text-sm">
                                Tu respuesta:
                                {{ optional($result['question']->answers->firstWhere('id', $result['selected']))->text ?? 'Sin respuesta' }}
                            </p>

                            <p class="text-sm">
                                Respuesta correcta:
                                {{ $result['question']->answers->firstWhere('id', $result['correct'])->text }}
                            </p>

                            <p class="text-sm font-semibold">
                                {{ $result['is_correct'] ? '✔ Correcta' : '✘ Incorrecta' }}
                            </p>

                        </div>

                    @endforeach

                </div>
            </div>

        </div>
    </div>

</x-app-layout>

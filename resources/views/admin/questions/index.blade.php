<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Preguntas · {{ $topic->name }}
            </h2>

            <a href="{{ route('admin.topics.index') }}"
               class="underline text-sm text-gray-600 hover:text-gray-900">
                ← Volver a topics
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="mb-4 p-3 border rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($questions->count() === 0)
                        <p>No hay preguntas todavía.</p>
                    @else
                        <ul class="list-disc pl-5 space-y-2 mt-4">

                            @foreach($questions as $q)

                                <li class="flex items-center justify-between">

                                    <span>{{ $q->text }}</span>

                                    <x-admin.actions
                                        :edit-url="route('admin.questions.edit', $q)"
                                        :delete-url="route('admin.questions.destroy', $q)"
                                        confirm-message="¿Seguro que quieres eliminar esta pregunta? Esta acción no se puede deshacer."
                                    />

                                </li>

                            @endforeach

                        </ul>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('admin.questions.create', $topic) }}"
                           class="underline text-sm text-gray-600 hover:text-gray-900">
                            + Crear pregunta
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

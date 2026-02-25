<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics</h2>

            <a href="{{ route('admin.topics.create') }}"
               class="underline text-sm text-gray-600 hover:text-gray-900">
                + Crear
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if($topics->count() === 0)
                        <p>No hay topics todavía.</p>
                    @else
                        <ul class="list-disc pl-5 space-y-2">

                            @foreach($topics as $topic)

                                <li class="flex items-center justify-between">

                                    <a href="{{ route('admin.questions.index', $topic) }}"
                                       class="underline">
                                        {{ $topic->name }}
                                    </a>

                                <x-admin.actions
                                    :edit-url="route('admin.topics.edit', $topic)"
                                    :delete-url="route('admin.topics.destroy', $topic)"
                                    :confirm-message="
                                        $topic->questions()->count()
                                        ? 'Este topic contiene preguntas. Si lo eliminas se eliminarán TODAS sus preguntas. Puedes editar el nombre del topic y conservar las preguntas. Cancela si quieres solo cambiar el nombre del topic. Acepta si quieres ELIMINAR definitivamente'
                                        : 'Este topic no contiene preguntas. Puedes eliminarlo o modificar su nombre. Acepta si quieres eliminar definitivamente'
                                    "
                                />

                                </li>

                            @endforeach

                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

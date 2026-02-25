<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Topic
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 border rounded">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.topics.update', $topic) }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block mb-1">Título</label>
                <input name="name" value="{{ old('name', $topic->name) }}" class="border rounded w-full p-2">
                @error('name') <div class="text-sm">{{ $message }}</div> @enderror
            </div>

            <button class="border rounded px-4 py-2">Guardar cambios</button>
            <a class="ml-2 underline" href="{{ route('admin.topics.index') }}">Volver</a>
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics</h2>

            <a href="{{ route('admin.topics.create') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
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
                                <li>{{ $topic->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $topic->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('topics.play.check', $topic) }}">
                        @csrf

                        @foreach($topic->questions as $question)

                            <div class="mb-6">
                                <p class="font-semibold">{{ $question->text }}</p>

                                <div class="mt-2 space-y-1">
                                    @foreach($question->answers as $answer)

                                        <label class="flex items-center gap-2">
                                            <input type="radio"
                                                   name="answers[{{ $question->id }}]"
                                                   value="{{ $answer->id }}">
                                            {{ $answer->text }}
                                        </label>

                                    @endforeach
                                </div>
                            </div>

                        @endforeach

                        <button type="submit" class="mt-4 underline">
                            Corregir
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>

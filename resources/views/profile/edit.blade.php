<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Avatar -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        Elige tu avatar
                    </h3>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                        <div class="flex gap-4 flex-wrap">

                            @foreach(['ashley','rodri','dani','endika','alondra','rocio'] as $avatar)

                                <label class="cursor-pointer">
                                    <input
                                        type="radio"
                                        name="avatar"
                                        value="{{ $avatar }}.png"
                                        class="hidden"
                                        {{ auth()->user()->avatar === $avatar.'.png' ? 'checked' : '' }}
                                    >

                                    <img
                                        src="{{ asset('assets/avatar/'.$avatar.'.png') }}"
                                        class="w-16 h-16 rounded-full border-2 hover:border-black"
                                    >
                                </label>

                            @endforeach

                        </div>

                        <button
                            type="submit"
                            class="mt-4 px-4 py-2 bg-black text-white rounded"
                        >
                            Guardar avatar
                        </button>

                    </form>

                </div>
            </div>

            <!-- Profile info -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete account -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>

    </div>
</x-app-layout>

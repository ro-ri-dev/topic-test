<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center space-x-6">
<a href="/admin" class="flex items-center">
    <img
        src="{{ asset('assets/logo.svg') }}"
        alt="Topic-Test"
        class="h-9 w-auto"
    >
</a>

                <a href="/admin"
                   class="{{ request()->is('admin') ? 'text-black font-semibold' : 'text-gray-600' }}">
                    Admin
                </a>

                <a href="/admin/topics"
                   class="{{ request()->is('admin/topics*') ? 'text-black font-semibold' : 'text-gray-600' }}">
                    Topics
                </a>
            </div>

            <!-- User -->
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">
                    {{ Auth::user()->email ?? '' }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600">
                        Log Out
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>

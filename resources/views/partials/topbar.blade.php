<header class="bg-white shadow-sm h-16 px-8 flex items-center justify-between">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $header ?? 'Dashboard' }}
        </h1>
    </div>

    <x-dropdown align="right" width="48">

    <x-slot name="trigger">
        <button
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition">

            <div
                class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div class="text-left">
                <p class="font-semibold text-gray-800">
                    {{ Auth::user()->name }}
                </p>

                <p class="text-xs text-gray-500">
                    Operator
                </p>
            </div>

            <svg class="w-4 h-4 text-gray-500"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"/>
            </svg>

        </button>
    </x-slot>

    <x-slot name="content">

        <x-dropdown-link :href="route('profile.edit')">
            Profile
        </x-dropdown-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link
                :href="route('logout')"
                onclick="event.preventDefault();
                        this.closest('form').submit();">
                Log Out
            </x-dropdown-link>

        </form>

    </x-slot>

</x-dropdown>

</header>

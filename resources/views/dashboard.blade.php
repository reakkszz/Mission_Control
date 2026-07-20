<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <h3 class="text-2xl font-bold mb-6">
            Welcome back, Sir {{ Auth::user()->name }}!
        </h3>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-gray-500 text-sm">Operations</p>
                <h2 class="text-2xl font-bold">{{ $operationCount }}</h2>
            </div>

            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-gray-500 text-sm">Missions</p>
                <h2 class="text-2xl font-bold">{{ $missionCount }}</h2>
            </div>

            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-gray-500 text-sm">Mission Logs</p>
                <h2 class="text-2xl font-bold">{{ $missLogCount }}</h2>
            </div>

            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-gray-500 text-sm">Intels</p>
                <h2 class="text-2xl font-bold">{{ $intelCount }}</h2>
            </div>

        </div>

        <div class="bg-white rounded-lg shadow p-5 mb-6">
            <div class="flex justify-between mb-2">
                <span class="font-semibold">Mission Progress</span>
                <span>{{ $completedMissions }}/{{ $totalMissions }}</span>
            </div>

            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-blue-600 h-3 rounded-full"
                    style="width: {{ $progress}}%">
                </div>
            </div>

            <p class="mt-2 text-sm text-gray-600">
                {{ $progress }}% Completed
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">

            <div class="bg-white shadow rounded-lg p-5">
                <h3 class="font-semibold mb-3">Recent Missions</h3>

                @forelse($recentMissions as $mission)
                    <div class="border-b py-2">
                        {{ $mission->title }}
                    </div>
                @empty
                    <p class="text-gray-500">No missions yet.</p>
                @endforelse
            </div>

            <div class="bg-white shadow rounded-lg p-5">
                <h3 class="font-semibold mb-3">Recent Intels</h3>

                @forelse($recentIntels as $intel)
                    <div class="border-b py-2">
                        {{ $intel->title }}
                    </div>
                @empty
                    <p class="text-gray-500">No intel yet.</p>
                @endforelse
            </div>

        </div>

    </div>
</div>
</x-app-layout>

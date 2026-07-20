<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <h3 class="text-3xl font-bold">Missions</h3>

                <a href="{{ route('missions.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    + New Mission
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('success')}}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                @if ($missions->isEmpty())
                    <div class="text-center py-12">

                        <h3 class="text-xl font-semibold text-gray-800">
                            No Missions Found
                        </h3>

                        <p class="mt-2 text-gray-500">
                            Create your first mission.
                        </p>

                        <a href="{{ route('missions.create')}}"
                            class="inline-block mt-6 bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                            + Create Mission
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-3">Title</th>
                                    <th class="text-left py-3">Operation</th>
                                    <th class="text-left py-3">Status</th>
                                    <th class="text-left py-3">Deadline</th>
                                    <th class="text-left py-3">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($missions as $mission)
                                    <tr class="border-b">
                                        <td class="py-3">{{ $mission->title }}</td>
                                        <td class="py-3">{{ $mission->operation->name}}</td>
                                        <td class="py-3">{{ ucfirst($mission->status) }}</td>
                                        <td class="py-3">{{ $mission->deadline ? \Carbon\Carbon::parse($mission->deadline)-> format('Y M d') : '-'}}</td>

                                        <td class="py-3">
                                            <div class="flex gap-2">

                                            <a href="{{ route('missions.edit', $mission) }}"
                                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('missions.destroy', $mission)}}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this mission?')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

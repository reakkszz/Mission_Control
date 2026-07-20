<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Missions Logs') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <h3 class="text-3xl font-bold">Missions Log</h3>

                <a href="{{ route('misslogs.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    + New Mission Log
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('success')}}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                @if ($missLogs->isEmpty())
                    <div class="text-center py-12">

                        <h3 class="text-xl font-semibold text-gray-800">
                            No Mission Log Found
                        </h3>

                        <p class="mt-2 text-gray-500">
                            Create your first mission log
                        </p>

                        <a href="{{ route('misslogs.create')}}"
                            class="inline-block mt-6 bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                            + Create Mission Log
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-3">Title</th>
                                    <th class="text-left py-3">Mission</th>
                                    <th class="text-left py-3">Content</th>
                                    <th class="text-left py-3">Image</th>
                                    <th class="text-left py-3">Created At</th>
                                    <th class="text-left py-3">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($missLogs as $missLog)
                                    <tr class="border-b">
                                        <td class="py-3">{{ $missLog->title }}</td>
                                        <td class="py-3">{{ $missLog->mission->title}}</td>
                                        <td class="py-3">{{ Str::limit($missLog->content, 50) }}</td>
                                        <td class="py-3">
                                                @if ($missLog->image)
                                                    <img src="{{ asset('storage/' .$missLog->image)}}"
                                                        class="w-16 h-16 object-cover rounded">
                                                @else
                                                    -
                                                @endif
                                        </td>
                                        <td class="py-3">
                                            {{ $missLog->created_at->format('Y M d')}}
                                        </td>

                                        <td class="py-3">
                                            <div class="flex gap-2">

                                            <a href="{{ route('misslogs.edit', $missLog) }}"
                                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('misslogs.destroy', $missLog)}}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this mission log?')">

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

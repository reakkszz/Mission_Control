<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Operations') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <h3 class="text-3xl font-bold">Operations</h3>

                <a href="{{ route('operations.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    + New Operation
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('success')}}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                @if ($operations->isEmpty())
                    <div class="text-center py-12">

                        <h3 class="text-xl font-semibold text-gray-800">
                            No Operations Found
                        </h3>

                        <p class="mt-2 text-gray-500">
                            Create your first operation to start managing your missions.
                        </p>

                        <a href="{{ route('operations.create')}}"
                            class="inline-block mt-6 bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                            + Create Operation
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-3">Name</th>
                                    <th class="text-left py-3">Status</th>
                                    <th class="text-left py-3">Created</th>
                                    <th class="text-left py-3">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($operations as $operation)
                                    <tr class="border-b">
                                        <td class="py-3">{{ $operation->name }}</td>
                                        <td class="py-3">{{ ucfirst($operation->status) }}</td>
                                        <td class="py-3">{{ $operation->created_at->format('Y M d')}}</td>

                                        <td class="py-3">
                                            <div class="flex gap-2">

                                            <a href="{{ route('operations.edit', $operation) }}"
                                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('operations.destroy', $operation)}}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this operation?')">

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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Operation
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-6">
                    Edit Operation
                </h3>

                <form action="{{ route('operations.update', $operation)}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Operation Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name',$operation->name) }}"
                            class="w-full border rounded-lg px-4 py-2"
                        >

                        @error('name')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows ="5"
                            class="w-full border rounded-lg px-4 py-2"
                        >{{ old('description', $operation->description) }}</textarea>

                        @error('description')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label  class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded-lg px-4 py-2"
                        >
                            <option value="active" {{ old('status', $operation->status) === 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="completed" {{ old('status',$operation->status) === 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                        </select>

                        @error('status')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                        @enderror
                    </div>

                    <div class="flex gap-3">

                    <button
                    type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                        Update Operation
                    </button>

                    <a
                        href="{{ route('operations.index') }}"
                        class="bg-gray-200 px-5 py-2 rounded-lg"
                    >
                        Cancel
                    </a>
                </div>
            </div>
            </form>
        </div>
    </div>
</x-app-layout>


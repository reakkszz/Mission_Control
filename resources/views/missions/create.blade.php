<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Mission</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-6">
                    Create Mission
                </h3>

                <form action="{{ route('missions.store')}}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="operation_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Operation
                        </label>

                        <select
                            id="operation_id"
                            name="operation_id"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required
                        >
                            <option value="">--- Select Operation ---</option>

                            @foreach ($operations as $operation)
                                <option value="{{ $operation->id}}"
                                    {{ old('operation_id') == $operation->id ? 'selected' : ''}}>
                                    {{ $operation->name}}
                                </option>
                            @endforeach
                        </select>

                        @error('operation_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Title
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title')}}"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter Mission Title"
                            required
                        >

                        @error('title')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows ="5"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter Mission Description"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        >
                            <option value="todo"
                                {{old('status') == 'todo' ? 'selected' : ''}}>
                                Todo
                            </option>

                            <option value="in_progress"
                            {{old('status') == 'in_progress' ? 'selected' : ''}}>
                                In Progress
                            </option>

                            <option value="completed"
                            {{old('status') == 'completed' ? 'selected' : ''}}>
                            Completed
                            </option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                            Deadline
                        </label>

                        <input
                            type="date"
                            id="deadline"
                            name="deadline"
                            value="{{old('deadline')}}"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        @error('deadline')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700">
                            Save Mission
                        </button>

                        <a
                            href="{{ route('missions.index')}}"
                            class="bg-gray-200 text-gray-700 px-5 py-3 rounded-lg hover:bg-gray-300">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-app-layout>

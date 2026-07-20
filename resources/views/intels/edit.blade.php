<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Intel</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-6">
                    Edit Intel
                </h3>

                <form action="{{ route('intels.update', $intel)}}" method="POST">
                    @csrf
                    @method('PUT')


                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Title
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $intel->title)}}"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter Intel Title"
                            required
                        >

                        @error('title')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            Content
                        </label>

                        <textarea
                            id="content"
                            name="content"
                            rows ="5"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter Intel Content"
                        >{{ old('content', $intel->content) }}</textarea>

                        @error('content')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="source" class="block text-sm font-medium text-gray-700 mb-2">
                            Source
                        </label>

                        <input
                            type="text"
                            id="source"
                            name="source"
                            value="{{ old('source', $intel->source) }}"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Example: https://laravel.com/docs">

                        @error('source')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700">
                            Update Intel
                        </button>

                        <a
                            href="{{ route('intels.index')}}"
                            class="bg-gray-200 text-gray-700 px-5 py-3 rounded-lg hover:bg-gray-300">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-app-layout>

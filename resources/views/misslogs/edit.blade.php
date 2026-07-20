<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Mission Log</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-6">
                    Edit Mission Log
                </h3>

                <form action="{{ route('misslogs.update', $missLog)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="mission_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Mission
                        </label>

                        <select
                            id="mission_id"
                            name="mission_id"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required
                        >
                            <option value="">--- Select Mission ---</option>

                            @foreach ($missions as $mission)
                                <option value="{{ $mission->id}}"
                                    {{ old('mission_id', $missLog->mission_id) == $mission->id ? 'selected' : ''}}>
                                    {{ $mission->title}}
                                </option>
                            @endforeach
                        </select>

                        @error('mission_id')
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
                            value="{{ old('title', $missLog->title)}}"
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
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            content
                        </label>

                        <textarea
                            id="content"
                            name="content"
                            rows ="5"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter Mission Log Content"
                        >{{ old('content', $missLog->content) }}</textarea>

                        @error('content')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            Image
                        </label>

                        @if ($missLog->image)
                            <div class="mb-4">
                                <img
                                    src="{{ asset('storage/' . $missLog->image) }}"
                                    alt="Mission Log Image"
                                    class="w-32 h-32 object-cover rounded border">
                            </div>
                        @endif
                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/*"
                            class="w-full border-gray-300 rounded-lg px-4 py-2">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700">
                            Update Mission Log
                        </button>

                        <a
                            href="{{ route('misslogs.index')}}"
                            class="bg-gray-200 text-gray-700 px-5 py-3 rounded-lg hover:bg-gray-300">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-app-layout>

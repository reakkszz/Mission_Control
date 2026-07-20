<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('AI Assistant') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        <div class="bg-white rounded-xl shadow">

            <!-- Header -->
            <div class="border-b p-6">
                <h2 class="text-2xl font-bold">
                    AI Assistant
                </h2>

                <p class="text-gray-500 mt-1">
                    Ask anything about your operations, missions, or coding.
                </p>
            </div>

            <!-- Chat Area -->
            <div class="h-[450px] overflow-y-auto p-6 space-y-4">

                <div class="flex">
                    <div class="bg-gray-100 rounded-xl px-4 py-3 max-w-lg">
                        👋 Hello! I'm your Mission Control AI.
                        <br>
                        How can I help you today?
                    </div>
                </div>
            @if(isset($message))
                <div class="flex  justify-end">
                    <div class="bg-blue-600 text-white rounded-xl px-4 py-3 max-w-lg">
                        {{ $message }}
                    </div>
                </div>
            @endif

            @if(isset($reply))
                <div class="flex">
                    <div class="bg-gray-100 rounded-xl px-4 py-3 max-w-lg">
                        🤖 {{ $reply }}
                    </div>
                </div>
            @endif
            </div>


            <!-- Input -->
            <div class="border-t p-4">

                <form action="{{ route('ai.ask')}}" method="POST">
                    @csrf

                    <div class="flex gap-3">

                        <input
                            type="text"
                            name="message"
                            value="{{ old('message')}}"
                            placeholder="Type your message..."
                            class="flex-1 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 rounded-lg">
                            Send
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>

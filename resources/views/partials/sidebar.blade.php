<aside class="w-64 bg-slate-900 text-white min-h-screen">

    <div class="p-6 border-b border-slate-700">
        <h1 class="text-xl font-bold">
            🦇 Mission Control
        </h1>
    </div>

    <nav class="p-4">

        <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-lg hover:bg-slate-800">
            🏠 Dashboard
        </a>

        <a href="{{ route('operations.index')}}" class="block px-4 py-3 rounded-lg hover:bg-slate-800">
            📁 Operation
        </a>

        <a href="{{ route('missions.index')}}" class="block px-4 py-3 rounded-lg hover:bg-slate-800">
            📋 Mission
        </a>

        <a href="{{ route('misslogs.index')}}" class="block px-4 py-3 rounded-lg hover:bg-slate-800">
            📝 Mission Log
        </a>

        <a href="{{ route('intels.index')}}" class="block px-4 py-3 rounded-lg hover:bg-slate-800">
            💡Intel
        </a>

        <a href="{{ route('ai.index')}}" class="block px-4 py-3 rounded-lg hover:bg-slate-800">
            🤖 AI Assistant
        </a>

    </nav>

</aside>

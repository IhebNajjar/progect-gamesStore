<div class="bg-gray-800 text-white w-64 min-h-screen py-6">
    <div class="px-6 mb-10">
        <h2 class="text-2xl font-black tracking-tighter text-indigo-400">ADMIN CONTROL</h2>
    </div>
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : 'hover:bg-gray-700' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Statistics
        </a>
        <a href="{{ route('admin.games') }}" class="flex items-center px-6 py-3 transition duration-200 {{ request()->routeIs('admin.games*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            Manage Games
        </a>
        <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 transition duration-200 {{ request()->routeIs('admin.users*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Manage Users
        </a>
    </nav>
    <div class="mt-auto px-6 pt-10">
        <a href="{{ route('games.index') }}" class="text-xs text-gray-400 hover:text-white uppercase font-bold tracking-widest">← Back to Store</a>
    </div>
</div>

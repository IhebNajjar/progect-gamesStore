<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Game Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Search & Filter Bar --}}
            <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                <form action="{{ route('games.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <input type="text" name="search" placeholder="Search games..." value="{{ request('search') }}" class="rounded border-gray-300">
                    
                    <select name="genre" class="rounded border-gray-300">
                        <option value="all">All Genres</option>
                        <option value="RPG" {{ request('genre') == 'RPG' ? 'selected' : '' }}>RPG</option>
                        <option value="Action" {{ request('genre') == 'Action' ? 'selected' : '' }}>Action</option>
                        <option value="Soulslike" {{ request('genre') == 'Soulslike' ? 'selected' : '' }}>Soulslike</option>
                        <option value="Sports" {{ request('genre') == 'Sports' ? 'selected' : '' }}>Sports</option>
                    </select>

                    <select name="platform" class="rounded border-gray-300">
                        <option value="all">All Platforms</option>
                        <option value="PC" {{ request('platform') == 'PC' ? 'selected' : '' }}>PC</option>
                        <option value="PS5" {{ request('platform') == 'PS5' ? 'selected' : '' }}>PS5</option>
                        <option value="Xbox" {{ request('platform') == 'Xbox' ? 'selected' : '' }}>Xbox</option>
                    </select>

                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded font-bold hover:bg-indigo-700">Filter</button>
                </form>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($games as $game)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 flex flex-col">
                        @if($game->image_url)
                            <img src="{{ $game->image_url }}" alt="{{ $game->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                        
                        <div class="p-6 flex-grow">
                            <h3 class="text-lg font-bold text-gray-900">{{ $game->title }}</h3>
                            <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">{{ $game->genre }} | {{ $game->platform }}</p>
                            
                            <p class="mt-3 text-sm text-gray-600 line-clamp-2">
                                {{ $game->description ?: 'No description available for this game.' }}
                            </p>
                            
                            <div class="mt-4 flex justify-between items-baseline border-b pb-4">
                                <div>
                                    <p class="text-xl font-semibold text-indigo-600">${{ number_format($game->price, 2) }}</p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Purchase Price</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-orange-600">${{ number_format($game->price * 0.10, 2) }}</p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Borrow Fee (7 Days)</p>
                                </div>
                            </div>
                            
                            <div class="mt-3 flex justify-between items-center">
                                <p class="text-xs {{ $game->stock > 0 ? 'text-green-600' : 'text-red-600' }} font-bold">
                                    {{ $game->stock > 0 ? 'Stock: ' . $game->stock : 'Out of Stock' }}
                                </p>
                            </div>
                            
                            <div class="mt-6">
                                <a href="{{ route('games.show', $game) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

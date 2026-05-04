<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $game->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        @if($game->image_url)
                            <img src="{{ $game->image_url }}" alt="{{ $game->title }}" class="w-full rounded-lg shadow-md mb-6">
                        @else
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400 rounded-lg mb-6">No Image</div>
                        @endif

                        <h3 class="text-2xl font-bold mb-2">{{ $game->title }}</h3>
                        <p class="text-lg text-gray-600 mb-4">{{ $game->genre }} | {{ $game->platform }}</p>
                        
                        <div class="prose max-w-none text-gray-700 mb-6">
                            <h4 class="font-bold text-gray-900">Description</h4>
                            <p>{{ $game->description ?: 'No description available for this game.' }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <div class="flex justify-between items-baseline mb-4">
                                <div>
                                    <p class="text-4xl font-bold text-indigo-600">${{ number_format($game->price, 2) }}</p>
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Purchase Price</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-bold text-orange-600">${{ number_format($game->price * 0.10, 2) }}</p>
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Borrow Fee (7 Days)</p>
                                </div>
                            </div>
                            <p class="mb-6">
                                Availability: 
                                <span class="{{ $game->stock > 0 ? 'text-green-600' : 'text-red-600' }} font-bold">
                                    {{ $game->stock > 0 ? $game->stock . ' items in stock' : 'Out of Stock' }}
                                </span>
                            </p>
                            
                            @auth
                                <div class="flex flex-col space-y-3">
                                    <form action="{{ route('games.buy', $game) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                            class="w-full inline-flex justify-center items-center px-4 py-3 bg-green-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-50 transition ease-in-out duration-150"
                                            {{ $game->stock <= 0 ? 'disabled' : '' }}>
                                            Buy Standard Edition
                                        </button>
                                    </form>

                                    <form action="{{ route('games.borrow', $game) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                            class="w-full inline-flex justify-center items-center px-4 py-3 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-50 transition ease-in-out duration-150"
                                            {{ $game->stock <= 0 ? 'disabled' : '' }}>
                                            Borrow for 7 Days
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="bg-indigo-50 p-4 rounded-md text-indigo-700 text-sm">
                                    Please <a href="{{ route('login') }}" class="font-bold underline">log in</a> to purchase or borrow this game.
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

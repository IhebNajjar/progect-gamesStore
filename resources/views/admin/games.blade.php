<x-app-layout>
    <div class="flex">
        @include('layouts.admin_sidebar')

        <div class="flex-1 py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-6">Inventory Management</h3>
                        
                        {{-- Add Game Form --}}
                        <div class="bg-gray-50 p-6 rounded-lg mb-10 border border-gray-200 shadow-inner">
                            <h4 class="font-bold mb-4 text-indigo-700">Add New Game</h4>
                            <form action="{{ route('admin.games.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @csrf
                                <input type="text" name="title" placeholder="Game Title" required class="rounded border-gray-300">
                                <input type="text" name="genre" placeholder="Genre" required class="rounded border-gray-300">
                                <input type="text" name="platform" placeholder="Platform" required class="rounded border-gray-300">
                                <div class="md:col-span-2">
                                    <input type="text" name="image_url" placeholder="Image URL" class="w-full rounded border-gray-300">
                                </div>
                                <input type="number" step="0.01" name="price" placeholder="Price" required class="rounded border-gray-300">
                                <input type="number" name="stock" placeholder="Initial Stock" required class="rounded border-gray-300">
                                <div class="md:col-span-3">
                                    <textarea name="description" placeholder="Description" class="w-full rounded border-gray-300" rows="2"></textarea>
                                </div>
                                <div class="md:col-span-3 text-right">
                                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded font-bold hover:bg-indigo-700">Create Game</button>
                                </div>
                            </form>
                        </div>

                        {{-- Games Table --}}
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Game Info</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price / Stock</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($games as $game)
                                        <tr class="hover:bg-gray-50">
                                            <form action="{{ route('admin.games.update', $game) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-16 w-12 flex-shrink-0">
                                                            <img class="h-16 w-12 rounded object-cover shadow-sm" src="{{ $game->image_url ?: 'https://via.placeholder.com/60x80' }}" alt="">
                                                        </div>
                                                        <div class="ml-4 space-y-1">
                                                            <input type="text" name="title" value="{{ $game->title }}" class="text-sm font-bold w-full rounded border-gray-300 py-1">
                                                            <input type="text" name="image_url" value="{{ $game->image_url }}" placeholder="Image URL" class="text-xs w-full rounded border-gray-300 py-0.5">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="space-y-1">
                                                        <div class="flex gap-1">
                                                            <input type="text" name="genre" value="{{ $game->genre }}" class="text-xs w-1/2 rounded border-gray-300 py-1">
                                                            <input type="text" name="platform" value="{{ $game->platform }}" class="text-xs w-1/2 rounded border-gray-300 py-1">
                                                        </div>
                                                        <textarea name="description" class="text-xs w-full rounded border-gray-300 py-1" rows="1">{{ $game->description }}</textarea>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="space-y-1">
                                                        <div class="flex items-center gap-1">
                                                            <span class="text-xs text-gray-500">$</span>
                                                            <input type="number" step="0.01" name="price" value="{{ $game->price }}" class="w-16 rounded border-gray-300 py-1 text-xs">
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                            <span class="text-xs text-gray-500 text-nowrap">St:</span>
                                                            <input type="number" name="stock" value="{{ $game->stock }}" class="w-12 rounded border-gray-300 py-1 text-xs font-bold">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex flex-col gap-1">
                                                        <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded text-xs font-bold hover:bg-indigo-700">Save</button>
                                            </form>
                                                        <form action="{{ route('admin.games.destroy', $game) }}" method="POST" onsubmit="return confirm('Remove this game?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-400 hover:text-red-700 text-xs font-medium">Remove</button>
                                                        </form>
                                                    </div>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

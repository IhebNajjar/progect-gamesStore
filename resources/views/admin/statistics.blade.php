<x-app-layout>
    <div class="flex">
        @include('layouts.admin_sidebar')

        <div class="flex-1 py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
                
                {{-- Summary Stats Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-widest">Total Sales</p>
                        <p class="text-3xl font-black text-indigo-700">${{ number_format($salesHistory->sum('price_paid'), 2) }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-widest">Active Borrowings</p>
                        <p class="text-3xl font-black text-indigo-700">{{ $activeBorrowings->count() }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-widest">Total Games</p>
                        <p class="text-3xl font-black text-indigo-700">{{ \App\Models\Game::count() }}</p>
                    </div>
                </div>

                {{-- Manual Borrowing Form (Admin only) --}}
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Manual Borrowing Assignment
                    </h3>
                    <form action="{{ route('borrowings.manual_store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Select User</label>
                            <select name="user_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Choose a user...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Select Game</label>
                            <select name="game_id" id="game_select" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Choose a game...</option>
                                @foreach($games as $game)
                                    <option value="{{ $game->id }}" data-price="{{ $game->price }}">{{ $game->title }} (${{ $game->price }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-150 ease-in-out shadow-sm">
                                Create Borrowing
                            </button>
                        </div>
                    </form>
                    <p class="mt-2 text-xs text-gray-400 italic font-medium">Fee (10%) will be calculated automatically.</p>
                </div>

                {{-- Sales & Borrowings Split --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Recent Sales --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6">
                            <h3 class="text-lg font-bold mb-4">Detailed Sales History</h3>
                            <div class="space-y-4">
                                @forelse($salesHistory as $sale)
                                    <div class="flex justify-between items-center p-3 border rounded-lg bg-gray-50">
                                        <div>
                                            <p class="font-bold text-sm">{{ $sale->game->title }}</p>
                                            <p class="text-xs text-gray-500">Buyer: {{ $sale->user->name }} | {{ $sale->created_at->format('M d, H:i') }}</p>
                                        </div>
                                        <p class="font-bold text-green-600">${{ number_format($sale->price_paid, 2) }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-400 text-sm text-center py-4 italic">No sales recorded yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- Active Borrowings --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6">
                            <h3 class="text-lg font-bold mb-4">Active Borrowings & Overdue</h3>
                            <div class="space-y-4">
                                @forelse($activeBorrowings as $borrowing)
                                    <div class="flex justify-between items-center p-3 border rounded-lg bg-gray-50">
                                        <div>
                                            <p class="font-bold text-sm">{{ $borrowing->game->title }}</p>
                                            <p class="text-xs text-gray-600">User: {{ $borrowing->user->name }}</p>
                                            <p class="text-xs text-indigo-600 font-bold">Fee: ${{ number_format($borrowing->fee, 2) }}</p>
                                            <p class="text-xs {{ $borrowing->due_date->isPast() ? 'font-bold text-red-600 animate-pulse' : 'text-gray-400' }}">Due: {{ $borrowing->due_date->format('M d') }}</p>
                                        </div>
                                        <form action="{{ route('admin.borrowings.return', $borrowing) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-xs font-bold hover:bg-green-700">Returned</button>
                                        </form>
                                    </div>
                                @empty
                                    <p class="text-gray-400 text-sm text-center py-4 italic">No active borrowings.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

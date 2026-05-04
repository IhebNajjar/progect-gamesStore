<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Games') }}
            </h2>
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Edit Profile') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Borrowed Games --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Borrowed Games</h3>
                    @if($borrowings->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-widest">Game</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-widest">Due Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-widest">Fee</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-widest">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($borrowings as $borrowing)
                                    <tr>
                                        <td class="px-6 py-4">{{ $borrowing->game->title }}</td>
                                        <td class="px-6 py-4">{{ $borrowing->due_date->toFormattedDateString() }}</td>
                                        <td class="px-6 py-4">${{ number_format($borrowing->fee, 2) }}</td>
                                        <td class="px-6 py-4">
                                            @if($borrowing->returned_at)
                                                <span class="text-green-600 font-bold">Returned ({{ $borrowing->returned_at->diffForHumans() }})</span>
                                            @else
                                                <span class="text-orange-600 font-bold">Active</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">You haven't borrowed any games yet.</p>
                    @endif
                </div>
            </div>

            {{-- Purchased Games --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Purchased Games</h3>
                    @if($purchases->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($purchases as $purchase)
                                <div class="border rounded-lg p-4 flex justify-between items-center">
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $purchase->game->title }}</p>
                                        <p class="text-sm text-gray-500 text-sm">Bought on {{ $purchase->created_at->toFormattedDateString() }}</p>
                                    </div>
                                    <p class="font-bold text-indigo-600">${{ number_format($purchase->price_paid, 2) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">You haven't bought any games yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

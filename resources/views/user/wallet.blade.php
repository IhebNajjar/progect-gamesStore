<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Wallet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Current Balance Card --}}
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
                    <div class="w-16 h-16 bg-indigo-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-widest mb-1">Current Balance</p>
                    <p class="text-5xl font-black text-gray-900">${{ number_format($user->balance, 2) }}</p>
                </div>

                {{-- Add Funds Card --}}
                <div class="bg-indigo-600 p-8 rounded-2xl shadow-xl text-white">
                    <h3 class="text-xl font-bold mb-4">Add Funds (Simulation)</h3>
                    <p class="text-indigo-100 text-sm mb-6">Enter the amount you would like to add to your simulated wallet. No real payment is required.</p>
                    
                    <form action="{{ route('wallet.deposit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-indigo-200 uppercase mb-2">Amount to Add ($)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-indigo-300 font-bold">$</span>
                                <input type="number" name="amount" step="0.01" min="1" required 
                                    class="block w-full pl-8 pr-4 py-3 bg-indigo-700 border-indigo-500 rounded-xl text-white placeholder-indigo-400 focus:ring-white focus:border-white transition"
                                    placeholder="0.00">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-white text-indigo-600 font-black py-4 px-6 rounded-xl hover:bg-indigo-50 transition transform hover:scale-[1.02] active:scale-[0.98]">
                            Confirm Deposit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

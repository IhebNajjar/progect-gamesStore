<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white text-center mb-2">
            {{ __('Recover Password') }}
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300 font-semibold" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="email" 
                              class="block w-full px-4 py-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl transition duration-150 ease-in-out" 
                              type="email" 
                              name="email" 
                              :value="old('email')" 
                              required 
                              autofocus 
                              placeholder="you@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col space-y-3">
            <x-primary-button class="w-full justify-center py-3 text-base font-bold bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 transform hover:scale-[1.02] rounded-xl shadow-lg shadow-indigo-200/50 dark:shadow-none">
                {{ __('Send Reset Link') }}
            </x-primary-button>
            
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                    {{ __('Back to login') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>

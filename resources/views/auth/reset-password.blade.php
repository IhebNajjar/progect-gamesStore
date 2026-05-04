<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white text-center mb-2">
            {{ __('Set New Password') }}
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
            {{ __('Please provide your email and your new password to complete the reset.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300 font-semibold" />
            <x-text-input id="email" 
                          class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" 
                          type="email" 
                          name="email" 
                          :value="old('email', $request->email)" 
                          required 
                          autofocus 
                          readonly 
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('New Password')" class="text-gray-700 dark:text-gray-300 font-semibold" />
            <x-text-input id="password" 
                          class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" 
                          type="password" 
                          name="password" 
                          required 
                          placeholder="••••••••"
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="text-gray-700 dark:text-gray-300 font-semibold" />
            <x-text-input id="password_confirmation" 
                          class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                          type="password"
                          name="password_confirmation" 
                          required 
                          placeholder="••••••••"
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="w-full justify-center py-3 text-base font-bold bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 transform hover:scale-[1.02] rounded-xl shadow-lg shadow-indigo-200/50 dark:shadow-none">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

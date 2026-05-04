<x-app-layout>
    <div class="flex">
        @include('layouts.admin_sidebar')

        <div class="flex-1 py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold">Edit User: {{ $user->name }}</h3>
                            <a href="{{ route('admin.users') }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Back to users</a>
                        </div>

                        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6 max-w-xl">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="phone" :value="__('Phone Number')" />
                                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>
                                <div>
                                    <x-input-label for="city" :value="__('City')" />
                                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('city')" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                            <hr class="my-6">

                            <div>
                                <h4 class="text-md font-medium text-gray-900 mb-2">Change Password</h4>
                                <p class="text-sm text-gray-500 mb-4">Leave blank to keep the current password.</p>
                                
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="password" :value="__('New Password')" />
                                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                    </div>
                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 pt-4">
                                <x-primary-button>{{ __('Update User') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

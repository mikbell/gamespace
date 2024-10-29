<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-900">
        <div class="w-full max-w-md">
            <div class="bg-gray-800 rounded-lg shadow-lg">
                <div class="p-4 text-lg font-semibold text-center text-gray-200 bg-gray-700">
                    {{ __('Reset Password') }}
                </div>

                <div class="p-6 text-gray-300">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-300">{{ __('Email Address') }}</label>
                            <input id="email" type="email" name="email" required
                                class="block w-full px-3 py-2 mt-1 text-gray-200 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
                            @error('email')
                                <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-300">{{ __('Password') }}</label>
                            <input id="password" type="password" name="password" required
                                class="block w-full px-3 py-2 mt-1 text-gray-200 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                autocomplete="new-password">
                            @error('password')
                                <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="block text-sm font-medium text-gray-300">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="block w-full px-3 py-2 mt-1 text-gray-200 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="flex justify-end mb-0">
                            <button type="submit" class="px-4 py-2 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

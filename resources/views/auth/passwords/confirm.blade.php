<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-900">
        <div class="w-full max-w-md">
            <div class="bg-gray-800 rounded-lg shadow-lg">
                <div class="p-4 text-lg font-semibold text-center text-gray-200 bg-gray-700">
                    {{ __('Confirm Password') }}
                </div>

                <div class="p-6 text-gray-300">
                    <p class="mb-4">{{ __('Please confirm your password before continuing.') }}</p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-300">{{ __('Password') }}</label>
                            <input id="password" type="password" name="password" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm>
                            @error('password')
                                <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="px-4 py-2 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                {{ __('Confirm Password') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="text-blue-400 hover:underline focus:outline-none" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

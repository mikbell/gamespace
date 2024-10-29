<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-900">
        <div class="w-full max-w-md">
            <div class="bg-gray-800 rounded-lg shadow-lg">
                <div class="p-4 text-lg font-semibold text-center text-gray-200 bg-gray-700">
                    {{ __('Verify Your Email Address') }}
                </div>

                <div class="p-6 text-gray-300">
                    @if (session('resent'))
                        <div class="p-3 mb-4 text-white bg-green-600 rounded">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <p class="mb-4">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                    <p class="mb-4">{{ __('If you did not receive the email') }},</p>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="text-blue-400 hover:underline focus:outline-none">
                            {{ __('click here to request another') }}
                        </button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

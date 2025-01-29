<x-guest-layout>
    <!-- Main Verification Container -->
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-white tracking-wider">Verify Email</h2>
            <p class="text-gray-300 text-sm">One last step to access your account</p>
        </div>

        <!-- Verification Message -->
        <div class="text-gray-300 text-sm leading-relaxed">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        <!-- Success Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="bg-green-900/50 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col space-y-4">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white rounded-lg font-medium hover:from-blue-500 hover:via-purple-500 hover:to-pink-500 transition-all duration-300 transform hover:scale-105">
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full py-3 px-4 bg-gray-800/50 border border-gray-700 text-gray-300 rounded-lg font-medium hover:bg-gray-700/50 transition-all duration-300">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>

        <!-- Help Text -->
        <div class="text-center text-sm text-gray-400">
            <p>Having trouble? Contact our support team</p>
        </div>
    </div>
</x-guest-layout>

<x-guest-layout>
    <!-- Main Container -->
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-white tracking-wider">Password Recovery</h2>
            <p class="text-gray-300 text-sm">We'll help you get back into your account</p>
        </div>

        <!-- Information Message -->
        <div class="bg-gray-900/30 border border-gray-700 text-gray-300 px-4 py-3 rounded-lg text-sm leading-relaxed">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="bg-green-900/30 border border-green-500/30 text-green-300 px-4 py-3 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Input -->
            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <div class="relative">
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                        placeholder="Enter your registered email" />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Actions -->
            <div class="space-y-4">
                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white rounded-lg font-medium hover:from-blue-500 hover:via-purple-500 hover:to-pink-500 transition-all duration-300 transform hover:scale-105">
                    {{ __('Send Reset Link') }}
                </button>

                <!-- Back to Login -->
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 transition-colors text-sm">
                        Return to login
                    </a>
                </div>
            </div>
        </form>

        <!-- Help Text -->
        <div class="text-center text-sm text-gray-400">
            <p>Need assistance? Contact our support team</p>
        </div>
    </div>
</x-guest-layout>

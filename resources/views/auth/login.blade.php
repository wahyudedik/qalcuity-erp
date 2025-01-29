<x-guest-layout>
    <!-- Main Login Container -->
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-white tracking-wider">Welcome Back</h2>
            <p class="text-gray-300 text-sm">Sign in to your account</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Input -->
            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <div class="relative">
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                        placeholder="Enter your email" />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password Input -->
            <div class="space-y-2">
                <x-input-label for="password" :value="__('Password')" class="text-white" />
                <div class="relative">
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                        placeholder="Enter your password" />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-purple-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-700 bg-gray-900/50 text-blue-500 focus:ring-blue-500">
                    <span class="text-sm text-gray-300">Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-gray-300 hover:text-blue-400 transition-colors">
                        Forgot Password?
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white rounded-lg font-medium hover:from-blue-500 hover:via-purple-500 hover:to-pink-500 transition-all duration-300 transform hover:scale-105">
                Sign In
            </button>

            <!-- Register Link -->
            <div class="text-center">
                <span class="text-gray-400">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 transition-colors ml-1">
                    Create one now
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>

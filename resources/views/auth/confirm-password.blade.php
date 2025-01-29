<x-guest-layout>
    <!-- Main Confirmation Container -->
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-white tracking-wider">Confirm Password</h2>
            <p class="text-gray-300 text-sm">Security verification required</p>
        </div>

        <!-- Security Message -->
        <div class="bg-blue-900/30 border border-blue-500/30 text-gray-300 px-4 py-3 rounded-lg text-sm">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <!-- Password Input -->
            <div class="space-y-2">
                <x-input-label for="password" :value="__('Password')" class="text-white" />
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                        placeholder="Enter your password" />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-purple-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Button -->
            <div class="space-y-4">
                <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white rounded-lg font-medium hover:from-blue-500 hover:via-purple-500 hover:to-pink-500 transition-all duration-300 transform hover:scale-105">
                    {{ __('Confirm') }}
                </button>

                <!-- Cancel Link -->
                <div class="text-center">
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-400 hover:text-gray-300 transition-colors text-sm">
                        Cancel and return to dashboard
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>

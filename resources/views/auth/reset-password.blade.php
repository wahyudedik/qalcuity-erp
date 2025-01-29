<x-guest-layout>
    <!-- Main Reset Password Container -->
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-white tracking-wider">Reset Password</h2>
            <p class="text-gray-300 text-sm">Create a new secure password for your account</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Input -->
            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <div class="relative">
                    <input 
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email', $request->email)"
                        required
                        autofocus
                        class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                        placeholder="Your email address"
                    />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- New Password Input -->
            <div class="space-y-2">
                <x-input-label for="password" :value="__('New Password')" class="text-white" />
                <div class="relative">
                    <input 
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                        placeholder="Enter new password"
                    />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-purple-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm New Password -->
            <div class="space-y-2">
                <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="text-white" />
                <div class="relative">
                    <input 
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                        placeholder="Confirm new password"
                    />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-pink-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <!-- Submit Button -->
            <div class="space-y-4">
                <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white rounded-lg font-medium hover:from-blue-500 hover:via-purple-500 hover:to-pink-500 transition-all duration-300 transform hover:scale-105">
                    Reset Password
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 transition-colors">
                        Back to login
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>

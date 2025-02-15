<x-guest-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-white tracking-wider">Reset Kata Sandi</h2>
            <p class="text-blue-100 text-sm">Buat kata sandi baru yang aman untuk akun Anda</p>
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
                        class="w-full px-4 py-3 bg-blue-900/50 border border-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent text-white placeholder-blue-200 transition-all duration-300"
                        placeholder="Your email address"
                    />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- New Password Input -->
            <div class="space-y-2">
                <x-input-label for="password" :value="__('Kata Sandi Baru')" class="text-white" />
                <div class="relative">
                    <input 
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="w-full px-4 py-3 bg-blue-900/50 border border-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent text-white placeholder-blue-200 transition-all duration-300"
                        placeholder="Enter new password"
                    />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm New Password -->
            <div class="space-y-2">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" class="text-white" />
                <div class="relative">
                    <input 
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full px-4 py-3 bg-blue-900/50 border border-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent text-white placeholder-blue-200 transition-all duration-300"
                        placeholder="Confirm new password"
                    />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <!-- Submit Button -->
            <div class="space-y-4">
                <button type="submit" 
                    class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                    Reset Kata Sandi
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-blue-100 hover:text-white transition-colors">
                        Kembali ke login
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>

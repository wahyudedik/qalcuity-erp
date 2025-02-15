<x-guest-layout>
    <!-- Main Login Container -->
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-white tracking-wider">Selamat Datang Kembali</h2>
            <p class="text-blue-100 text-sm">Masuk ke akun Anda</p>
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
                        class="w-full px-4 py-3 bg-blue-900/50 border border-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent text-white placeholder-blue-200 transition-all duration-300"
                        placeholder="Masukkan email Anda" />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>
            <!-- Password Input -->
            <div class="space-y-2">
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-white" />
                <div class="relative">
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 bg-blue-900/50 border border-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent text-white placeholder-blue-200 transition-all duration-300"
                        placeholder="Masukkan kata sandi Anda" />
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-200 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="eyeIcon" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>
            <script>
                function togglePassword() {
                    const passwordInput = document.getElementById('password');
                    const eyeIcon = document.getElementById('eyeIcon');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
        `;
                    } else {
                        passwordInput.type = 'password';
                        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        `;
                    }
                }
            </script>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember"
                        class="rounded border-blue-700 bg-blue-900/50 text-green-600 focus:ring-blue-400">
                    <span class="text-sm text-blue-100">Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-blue-100 hover:text-white transition-colors">
                        Lupa Kata Sandi?
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                Masuk
            </button>

            <!-- Register Link -->
            <div class="text-center">
                <span class="text-blue-100">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="text-white hover:text-blue-200 transition-colors ml-1">
                    Buat akun sekarang
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>

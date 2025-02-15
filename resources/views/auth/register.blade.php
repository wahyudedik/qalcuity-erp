<x-guest-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-white tracking-wider">Buat Akun</h2>
            <p class="text-blue-100 text-sm">Bergabunglah dengan membuat akun Anda</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name Input -->
            <div class="space-y-2">
                <x-input-label for="name" :value="__('Nama')" class="text-white" />
                <div class="relative">
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus
                        class="w-full px-4 py-3 bg-blue-900/50 border border-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent text-white placeholder-blue-200 transition-all duration-300"
                        placeholder="Masukkan nama lengkap Anda" />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Email Input -->
            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <div class="relative">
                    <input id="email" type="email" name="email" :value="old('email')" required
                        class="w-full px-4 py-3 bg-blue-900/50 border border-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent text-white placeholder-blue-200 transition-all duration-300"
                        placeholder="Masukkan alamat email Anda" />
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
                        placeholder="Buat kata sandi yang kuat" />
                    <button type="button" onclick="togglePassword('password', 'eyeIcon1')"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-200 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="eyeIcon1" fill="none"
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

            <!-- Confirm Password -->
            <div class="space-y-2">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-white" />
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 bg-blue-900/50 border border-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent text-white placeholder-blue-200 transition-all duration-300"
                        placeholder="Konfirmasi kata sandi Anda" />
                    <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-200 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="eyeIcon2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <script>
                function togglePassword(inputId, iconId) {
                    const passwordInput = document.getElementById(inputId);
                    const eyeIcon = document.getElementById(iconId);

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

            <!-- Register Button and Login Link -->
            <div class="space-y-4">
                <button type="submit"
                    class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                    Buat Akun
                </button>

                <div class="text-center">
                    <span class="text-blue-100">Sudah punya akun?</span>
                    <a href="{{ route('login') }}" class="text-white hover:text-blue-200 transition-colors ml-1">
                        Masuk
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>

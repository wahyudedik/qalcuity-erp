<x-guest-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-white tracking-wider">Konfirmasi Kata Sandi</h2>
            <p class="text-blue-100 text-sm">Verifikasi keamanan diperlukan</p>
        </div>

        <!-- Security Message -->
        <div class="bg-blue-800/30 border border-blue-400/30 text-blue-100 px-4 py-3 rounded-lg text-sm">
            {{ __('Ini adalah area aman aplikasi. Harap konfirmasi kata sandi Anda sebelum melanjutkan.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <!-- Password Input -->
            <div class="space-y-2">
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-white" />
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 bg-blue-900/50 border border-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent text-white placeholder-blue-200 transition-all duration-300"
                        placeholder="Masukkan kata sandi Anda" />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Button -->
            <div class="space-y-4">
                <button type="submit"
                    class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                    {{ __('Konfirmasi') }}
                </button>

                <!-- Cancel Link -->
                <div class="text-center">
                    <a href="{{ route('dashboard') }}" class="text-blue-100 hover:text-white transition-colors text-sm">
                        Batal dan kembali ke dasbor
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>

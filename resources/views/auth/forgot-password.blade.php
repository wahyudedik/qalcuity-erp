<x-guest-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-white tracking-wider">Pemulihan Kata Sandi</h2>
            <p class="text-blue-100 text-sm">Kami akan membantu Anda masuk kembali ke akun Anda</p>
        </div>

        <!-- Information Message -->
        <div class="bg-blue-800/30 border border-blue-400/30 text-blue-100 px-4 py-3 rounded-lg text-sm leading-relaxed">
            {{ __('Lupa kata sandi? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan reset kata sandi yang akan memungkinkan Anda memilih yang baru.') }}
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="bg-green-600/30 border border-green-500/30 text-green-100 px-4 py-3 rounded-lg text-sm">
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
                        class="w-full px-4 py-3 bg-blue-900/50 border border-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent text-white placeholder-blue-200 transition-all duration-300"
                        placeholder="Masukkan email terdaftar Anda" />
                    <div class="absolute inset-0 rounded-lg blur opacity-50 bg-blue-500/20 -z-10"></div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Actions -->
            <div class="space-y-4">
                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                    {{ __('Kirim Tautan Reset') }}
                </button>

                <!-- Back to Login -->
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-blue-100 hover:text-white transition-colors text-sm">
                        Kembali ke halaman masuk
                    </a>
                </div>
            </div>
        </form>

        <!-- Help Text -->
        <div class="text-center text-sm text-blue-100">
            <p>Butuh bantuan? Hubungi tim dukungan kami</p>
        </div>
    </div>
</x-guest-layout>

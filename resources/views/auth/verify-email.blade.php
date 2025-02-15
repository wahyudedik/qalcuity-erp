<x-guest-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-white tracking-wider">Verifikasi Email</h2>
            <p class="text-blue-100 text-sm">Satu langkah lagi untuk mengakses akun Anda</p>
        </div>

        <!-- Verification Message -->
        <div class="bg-blue-800/30 border border-blue-400/30 text-blue-100 text-sm leading-relaxed px-4 py-3 rounded-lg">
            {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan? Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan yang baru.') }}
        </div>

        <!-- Success Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="bg-green-600/30 border border-green-500/30 text-green-100 px-4 py-3 rounded-lg">
                {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col space-y-4">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full py-3 px-4 bg-blue-900/50 border border-blue-700 text-blue-100 rounded-lg font-medium hover:bg-blue-800/50 transition-all duration-300">
                    {{ __('Keluar') }}
                </button>
            </form>
        </div>

        <!-- Help Text -->
        <div class="text-center text-sm text-blue-100">
            <p>Mengalami masalah? Hubungi tim dukungan kami</p>
        </div>
    </div>
</x-guest-layout>

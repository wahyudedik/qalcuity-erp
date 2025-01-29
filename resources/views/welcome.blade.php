<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Qalcuity ERP: Solusi Akurat untuk Manajemen Bisnis Modern</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">
    <!-- Header -->
    <header class="fixed w-full bg-white shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-blue-900">Qalcuity ERP</span>
                </div>
                <nav class="hidden md:flex space-x-8 items-center">
                    <a href="#features" class="text-gray-700 hover:text-blue-900">Fitur</a>
                    <a href="#benefits" class="text-gray-700 hover:text-blue-900">Manfaat</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-blue-900">Testimoni</a>
                    <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                        <a href="/login">Coba Demo</a>
                    </button>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-900 to-blue-800 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        Transformasi Digital Bisnis Anda dengan Qalcuity ERP
                    </h1>
                    <p class="text-xl text-blue-100 mb-8">
                        Platform ERP modern yang menggabungkan keakuratan, efisiensi, dan kemudahan penggunaan untuk
                        pertumbuhan bisnis yang berkelanjutan.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <button
                            class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition duration-300">
                            <a href="/login">Mulai Demo Gratis</a>
                        </button>
                        <button
                            class="bg-white hover:bg-gray-100 text-blue-900 px-8 py-4 rounded-lg text-lg font-semibold transition duration-300 flex items-center justify-center">
                            <span>Lihat Video Demo</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="relative">
                    <div class="bg-white rounded-lg shadow-2xl p-6">
                        <img src="/img/dashboard-preview.png" alt="Qalcuity ERP Dashboard" class="rounded-lg w-full">
                        <div
                            class="absolute -bottom-4 -right-4 bg-green-600 text-white px-6 py-2 rounded-full text-sm font-medium">
                            Live Preview
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trust Indicators -->
            <div class="mt-16 pt-8 border-t border-blue-700">
                <p class="text-center text-blue-200 mb-6">Dipercaya oleh perusahaan terkemuka</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-items-center">
                    <img src="/img/client-logo-1.png" alt="Client Logo" class="h-12 opacity-75">
                    <img src="/img/client-logo-2.png" alt="Client Logo" class="h-12 opacity-75">
                    <img src="/img/client-logo-3.png" alt="Client Logo" class="h-12 opacity-75">
                    <img src="/img/client-logo-4.png" alt="Client Logo" class="h-12 opacity-75">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Fitur Unggulan</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Manajemen Keuangan</h3>
                    <p class="text-gray-600">Kelola keuangan dengan akurat dan real-time untuk pengambilan keputusan
                        yang lebih baik</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Otomatisasi Proses</h3>
                    <p class="text-gray-600">Otomatisasi workflow untuk meningkatkan efisiensi dan mengurangi kesalahan
                        manual</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Analisis Real-Time</h3>
                    <p class="text-gray-600">Dashboard dan laporan real-time untuk monitoring performa bisnis</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Integrasi Mudah</h3>
                    <p class="text-gray-600">Integrasi seamless dengan sistem dan aplikasi bisnis lainnya</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Manfaat Menggunakan Qalcuity ERP</h2>
                <p class="mt-4 text-xl text-gray-600">Tingkatkan efisiensi dan produktivitas bisnis Anda</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Peningkatan Efisiensi</h3>
                    <p class="text-gray-600">Otomatisasi proses bisnis mengurangi waktu operasional hingga 50% dan
                        meminimalkan kesalahan manual.</p>
                </div>

                <!-- Benefit 2 -->
                <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Keputusan Lebih Cepat</h3>
                    <p class="text-gray-600">Analisis data real-time memungkinkan pengambilan keputusan yang lebih
                        cepat dan akurat.</p>
                </div>

                <!-- Benefit 3 -->
                <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Penghematan Biaya</h3>
                    <p class="text-gray-600">Optimalisasi proses dan sumber daya menghasilkan penghematan biaya
                        operasional yang signifikan.</p>
                </div>

                <!-- Benefit 4 -->
                <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Kolaborasi Tim</h3>
                    <p class="text-gray-600">Tingkatkan komunikasi dan kolaborasi antar departemen dengan sistem
                        terintegrasi.</p>
                </div>

                <!-- Benefit 5 -->
                <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Keamanan Data</h3>
                    <p class="text-gray-600">Sistem keamanan berlapis melindungi data bisnis Anda dengan standar
                        industri terkini.</p>
                </div>

                <!-- Benefit 6 -->
                <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Skalabilitas</h3>
                    <p class="text-gray-600">Sistem yang tumbuh seiring perkembangan bisnis Anda dengan kemudahan
                        penambahan fitur.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Apa Kata Klien Kami</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-xl">
                    <p class="text-gray-600 mb-4">"Qalcuity ERP telah membantu kami mengotomatisasi proses bisnis dan
                        meningkatkan akurasi laporan keuangan."</p>
                    <div class="flex items-center">
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-gray-900">Ahmad Syafiq</p>
                            <p class="text-sm text-gray-500">CEO, PT Maju Bersama</p>
                        </div>
                    </div>
                </div>
                <!-- Add more testimonials as needed -->
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-blue-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-8">Siap Meningkatkan Efisiensi Bisnis Anda?</h2>
            <button class="bg-green-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-green-700">
                <a href="/login">Mulai Demo Gratis Sekarang</a>
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white font-bold mb-4">Qalcuity ERP</h3>
                    <p class="text-sm">Solusi manajemen bisnis terpadu untuk perusahaan modern</p>
                </div>
                <!-- Add more footer content as needed -->
            </div>
        </div>
    </footer>
</body>

</html>

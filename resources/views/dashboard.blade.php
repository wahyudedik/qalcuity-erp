@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Header Section -->
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </header>

    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Greeting Section -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Selamat Datang,
                    {{ Auth::user()->name }}!</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Berikut adalah modul-modul yang tersedia untuk
                    manajemen pabrik beton cair.</p>
            </div>

            <!-- Main Module Cards -->
            <h4 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Modul Utama</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8">
                <!-- Keuangan Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h5 class="ml-3 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Keuangan
                            </h5>
                        </div>
                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                            <li>• Akuntansi & Pembukuan</li>
                            <li>• Penggajian</li>
                            <li>• Manajemen Biaya</li>
                            <li>• Pelaporan Keuangan</li>
                        </ul>
                        <a href="#"
                            class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Akses Modul
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Penjualan Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z">
                                    </path>
                                </svg>
                            </div>
                            <h5 class="ml-3 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Penjualan
                            </h5>
                        </div>
                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                            <li>• Manajemen Pelanggan</li>
                            <li>• Penawaran & Kontrak</li>
                            <li>• Invoice & Pembayaran</li>
                        </ul>
                        <a href="#"
                            class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Akses Modul
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Sisanya tetap sama, hanya lanjutkan dengan semua card dan konten lainnya -->
                <!-- ... -->

            </div>

            <!-- Quick Stats Section -->
            <!-- ... -->

            <!-- Secondary Modules Section -->
            <!-- ... -->

            <!-- Recent Activities Section -->
            <!-- ... -->

            <!-- To Do List Section -->
            <!-- ... -->

            <!-- Shortcuts Section -->
            <!-- ... -->

            <!-- Footer Section -->
            <div class="mt-8 text-center text-gray-500 dark:text-gray-400 text-sm">
                <p>© {{ date('Y') }} Sistem Manajemen Pabrik Beton Cair. Versi 2.0.0</p>
                <p class="mt-1">Terakhir diperbarui: {{ date('d M Y - H:i') }} WIB</p>
            </div>
        </div>
    </div>
@endsection

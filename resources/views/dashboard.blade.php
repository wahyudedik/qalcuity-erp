<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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

                <!-- Produksi Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h5 class="ml-3 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Produksi
                            </h5>
                        </div>
                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                            <li>• Perencanaan Produksi</li>
                            <li>• Manajemen Bahan Baku</li>
                            <li>• Quality Control</li>
                            <li>• Monitoring Batch Plant</li>
                        </ul>
                        <a href="#"
                            class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                            Akses Modul
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Gudang Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h5 class="ml-3 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Gudang</h5>
                        </div>
                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                            <li>• Inventory Bahan Baku</li>
                            <li>• Inventory Produk Jadi</li>
                            <li>• Manajemen Silo</li>
                            <li>• Stock Opname</li>
                        </ul>
                        <a href="#"
                            class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                            Akses Modul
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Karyawan Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                    </path>
                                </svg>
                            </div>
                            <h5 class="ml-3 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Karyawan
                            </h5>
                        </div>
                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                            <li>• Data Karyawan</li>
                            <li>• Absensi</li>
                            <li>• Shift Kerja</li>
                            <li>• Penggajian</li>
                        </ul>
                        <a href="#"
                            class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                            Akses Modul
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Pengiriman Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-red-100 dark:bg-red-900 rounded-lg">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z">
                                    </path>
                                    <path
                                        d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-5h-1a1 1 0 01-1-1V6a1 1 0 011-1h3.5l.5.5V8h1V5.5A1.5 1.5 0 0014.5 4H3zm11 10a2.5 2.5 0 00-2.45 2h-6.1a2.5 2.5 0 00-4.9 0H3V5h11.5a.5.5 0 01.5.5V14z">
                                    </path>
                                </svg>
                            </div>
                            <h5 class="ml-3 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Pengiriman
                            </h5>
                        </div>
                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                            <li>• Rute Pengiriman</li>
                            <li>• Manajemen Armada</li>
                            <li>• Penjadwalan</li>
                            <li>• GPS Tracking</li>
                        </ul>
                        <a href="#"
                            class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Akses Modul
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Pembelian Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-pink-100 dark:bg-pink-900 rounded-lg">
                                <svg class="w-6 h-6 text-pink-600 dark:text-pink-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h5 class="ml-3 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Pembelian
                            </h5>
                        </div>
                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                            <li>• Manajemen Supplier</li>
                            <li>• Purchase Order</li>
                            <li>• Evaluasi Supplier</li>
                        </ul>
                        <a href="#"
                            class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium text-center text-white bg-pink-700 rounded-lg hover:bg-pink-800 focus:ring-4 focus:outline-none focus:ring-pink-300 dark:bg-pink-600 dark:hover:bg-pink-700 dark:focus:ring-pink-800">
                            Akses Modul
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Maintenance Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-teal-100 dark:bg-teal-900 rounded-lg">
                                <svg class="w-6 h-6 text-teal-600 dark:text-teal-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h5 class="ml-3 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Maintenance
                            </h5>
                        </div>
                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                            <li>• Perawatan Mixer</li>
                            <li>• Perawatan Pompa</li>
                            <li>• Perawatan Kendaraan</li>
                            <li>• Perawatan Batch Plant</li>
                        </ul>
                        <a href="#"
                            class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium text-center text-white bg-teal-700 rounded-lg hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">
                            Akses Modul
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="my-8">
                <h4 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Statistik Cepat</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Production Stat -->
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Produksi Bulan
                                        Ini</div>
                                    <div class="text-xl font-semibold text-gray-900 dark:text-white">1,250 m³</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Stat -->
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z">
                                        </path>
                                        <path
                                            d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-5h-1a1 1 0 01-1-1V6a1 1 0 011-1h3.5l.5.5V8h1V5.5A1.5 1.5 0 0014.5 4H3z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Pengiriman Hari
                                        Ini</div>
                                    <div class="text-xl font-semibold text-gray-900 dark:text-white">18 truk</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Stat -->
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm4.707 3.707a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-2.293 2.293a1 1 0 101.414 1.414l4-4a1 1 0 000-1.414l-4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Order Menunggu
                                    </div>
                                    <div class="text-xl font-semibold text-gray-900 dark:text-white">24 order</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inventory Stat -->
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="p-2 bg-red-100 dark:bg-red-900 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600 dark:text-red-300" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm9 4a1 1 0 10-2 0v6a1 1 0 102 0V7zm-3 2a1 1 0 10-2 0v4a1 1 0 102 0V9zm-3 3a1 1 0 10-2 0v1a1 1 0 102 0v-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Stok Semen</div>
                                    <div class="text-xl font-semibold text-gray-900 dark:text-white">72%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Modules Section -->
            <h4 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Modul Pendukung</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                <!-- Proyek Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-col items-center">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg mb-2">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">Proyek
                        </h5>
                    </div>
                </div>

                <!-- QHSE Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-col items-center">
                        <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg mb-2">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">QHSE
                        </h5>
                    </div>
                </div>

                <!-- Laboratorium Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-col items-center">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg mb-2">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7 2a1 1 0 00-.707 1.707L7 4.414v3.758a1 1 0 01-.293.707l-4 4C.817 14.769 2.156 18 4.828 18h10.343c2.673 0 4.012-3.231 2.122-5.121l-4-4A1 1 0 0113 8.172V4.414l.707-.707A1 1 0 0013 2H7zm2 6.172V4h2v4.172a3 3 0 00.879 2.12l1.168 1.168a4 4 0 00-2.094.578l-.979.978a4 4 0 00-2.122-.617l1.168-1.168A3 3 0 009 8.172z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">
                            Laboratorium</h5>
                    </div>
                </div>

                <!-- Business Intelligence Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-col items-center">
                        <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg mb-2">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">Business
                            Intelligence</h5>
                    </div>
                </div>

                <!-- Manajemen Risiko Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-col items-center">
                        <div class="p-2 bg-red-100 dark:bg-red-900 rounded-lg mb-2">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">
                            Manajemen Risiko</h5>
                    </div>
                </div>

                <!-- Integrasi & IoT Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-col items-center">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg mb-2">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 7H7v6h6V7z"></path>
                                <path fill-rule="evenodd"
                                    d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">
                            Integrasi & IoT</h5>
                    </div>
                </div>

                <!-- Lingkungan Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-col items-center">
                        <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg mb-2">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">
                            Keberlanjutan</h5>
                    </div>
                </div>

                <!-- Mobile Access Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-col items-center">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg mb-2">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">Mobile
                            Access</h5>
                    </div>
                </div>

                <!-- Customer Portal Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-col items-center">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg mb-2">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">Customer
                            Portal</h5>
                    </div>
                </div>

                <!-- Document Management Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-col items-center">
                        <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg mb-2">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">
                            Manajemen Dokumen</h5>
                    </div>
                </div>

                <!-- More Card -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="p-4 flex flex-col items-center">
                        <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mb-2">
                            <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                </path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">Lihat
                            Semua</h5>
                    </div>
                </div>
            </div>

            <!-- Recent Activities Section -->
            <div class="mt-8">
                <h4 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Aktivitas Terbaru</h4>
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-4">
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-300"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Produksi Batch #45782 selesai
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Quality Control OK
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            35 menit yang lalu
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-300"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Order #12385 telah dikirimkan
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                PT. Konstruksi Makmur
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            1 jam yang lalu
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-8 h-8 rounded-full bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-300"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Peringatan Stok Pasir Menipis
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Sisa 12% - Perlu pemesanan segera
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            3 jam yang lalu
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-purple-600 dark:text-purple-300"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Meeting Jadwal Produksi Minggu Depan
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                5 Peserta Hadir
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            5 jam yang lalu
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-red-600 dark:text-red-300"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Mixer #3 Memerlukan Pemeliharaan
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Jadwalkan maintenance segera
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            8 jam yang lalu
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-3">
                            <a href="#"
                                class="inline-flex items-center text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                Lihat semua aktivitas
                                <svg class="w-3 h-3 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- To Do List Section -->
            <div class="mt-8 mb-6">
                <h4 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Tugas Anda</h4>
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-4">
                        <div class="flow-root">
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                <li class="py-3 flex items-center">
                                    <input id="todo-1" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="todo-1"
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Periksa
                                        laporan quality control batch hari ini</label>
                                </li>
                                <li class="py-3 flex items-center">
                                    <input id="todo-2" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="todo-2"
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Konfirmasi
                                        pengiriman untuk PT. Bangunan Jaya</label>
                                </li>
                                <li class="py-3 flex items-center">
                                    <input id="todo-3" type="checkbox" checked
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="todo-3"
                                        class="ms-3 text-sm font-medium line-through text-gray-500 dark:text-gray-400">Update
                                        stok bahan baku di sistem</label>
                                </li>
                                <li class="py-3 flex items-center">
                                    <input id="todo-4" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="todo-4"
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Review jadwal
                                        shift karyawan untuk minggu depan</label>
                                </li>
                                <li class="py-3 flex items-center">
                                    <input id="todo-5" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="todo-5"
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Jadwalkan
                                        maintenance untuk Mixer #3</label>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-4 flex items-center">
                            <button type="button"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 1v16M1 9h16" />
                                </svg>
                                Tambah Tugas Baru
                            </button>
                            <a href="#"
                                class="ms-auto text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                Lihat semua tugas
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shortcuts Section -->
            <div class="mt-8 mb-6">
                <h4 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Pintasan Cepat</h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <!-- Shortcut 1 -->
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                        <a href="#" class="p-4 flex flex-col items-center">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg mb-2">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white text-center">Input Order
                            </div>
                        </a>
                    </div>

                    <!-- Shortcut 2 -->
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                        <a href="#" class="p-4 flex flex-col items-center">
                            <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg mb-2">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white text-center">Laporan Harian
                            </div>
                        </a>
                    </div>

                    <!-- Shortcut 3 -->
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                        <a href="#" class="p-4 flex flex-col items-center">
                            <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg mb-2">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white text-center">Chat Tim</div>
                        </a>
                    </div>

                    <!-- Shortcut 4 -->
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                        <a href="#" class="p-4 flex flex-col items-center">
                            <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg mb-2">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white text-center">Jadwal Produksi
                            </div>
                        </a>
                    </div>

                    <!-- Shortcut 5 -->
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                        <a href="#" class="p-4 flex flex-col items-center">
                            <div class="p-2 bg-red-100 dark:bg-red-900 rounded-lg mb-2">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0v3H7V4h6zm-5 7a1 1 0 112 0 1 1 0 01-2 0zm6 0a1 1 0 112 0 1 1 0 01-2 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white text-center">Cetak Delivery
                            </div>
                        </a>
                    </div>

                    <!-- Shortcut 6 -->
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                        <a href="#" class="p-4 flex flex-col items-center">
                            <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg mb-2">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-300" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                </svg>
                            </div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white text-center">Statistik
                                Bulanan</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer Section -->
            <div class="mt-8 text-center text-gray-500 dark:text-gray-400 text-sm">
                <p>© {{ date('Y') }} Sistem Manajemen Pabrik Beton Cair. Versi 2.0.0</p>
                <p class="mt-1">Terakhir diperbarui: {{ date('d M Y - H:i') }} WIB</p>
            </div>
        </div>
    </div>
</x-app-layout>

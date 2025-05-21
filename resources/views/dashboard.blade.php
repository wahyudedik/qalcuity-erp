@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan performa bisnis terkini')

@section('breadcrumb')
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Home
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Dashboard</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Produksi Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-500 bg-opacity-10 mr-4">
                    <svg class="w-6 h-6 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 18 18">
                        <path
                            d="M17 16h-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v14H1a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium dark:text-gray-400">Total Produksi</p>
                    <p class="text-2xl font-semibold text-gray-700 dark:text-white">875 m³</p>
                    <p class="text-sm text-green-500">
                        <span class="font-medium">+12.5%</span> dari bulan lalu
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-500 bg-opacity-10 mr-4">
                    <svg class="w-6 h-6 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 16">
                        <path
                            d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 11h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1Zm2-3h-6a.5.5 0 0 1 0-1h6a.5.5 0 0 1 0 1Zm9.5 3h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1Zm0-3h-6a.5.5 0 0 1 0-1h6a.5.5 0 0 1 0 1Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium dark:text-gray-400">Total Pendapatan</p>
                    <p class="text-2xl font-semibold text-gray-700 dark:text-white">Rp 875,5 jt</p>
                    <p class="text-sm text-green-500">
                        <span class="font-medium">+8.3%</span> dari bulan lalu
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Pesanan Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-500 bg-opacity-10 mr-4">
                    <svg class="w-6 h-6 text-purple-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5 0H1a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1Zm14 0h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM5 14H1a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1Zm14 0h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1ZM12 2H8a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1Zm0 10H8a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium dark:text-gray-400">Total Pesanan</p>
                    <p class="text-2xl font-semibold text-gray-700 dark:text-white">126</p>
                    <p class="text-sm text-green-500">
                        <span class="font-medium">+5.2%</span> dari bulan lalu
                    </p>
                </div>
            </div>
        </div>

        <!-- Efisiensi Produksi Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-orange-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-500 bg-opacity-10 mr-4">
                    <svg class="w-6 h-6 text-orange-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5 11.424V1a1 1 0 0 0-2 0v10.424a3.228 3.228 0 0 0 0 6.152V19a1 1 0 1 0 2 0v-1.424a3.228 3.228 0 0 0 0-6.152ZM19.25 14.5A3.243 3.243 0 0 0 17 11.424V1a1 1 0 0 0-2 0v10.424a3.227 3.227 0 0 0 0 6.152V19a1 1 0 1 0 2 0v-1.424a3.243 3.243 0 0 0 2.25-3.076Zm-6-9A3.243 3.243 0 0 0 11 2.424V1a1 1 0 0 0-2 0v1.424a3.228 3.228 0 0 0 0 6.152V19a1 1 0 1 0 2 0V8.576A3.243 3.243 0 0 0 13.25 5.5Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium dark:text-gray-400">Efisiensi Produksi</p>
                    <p class="text-2xl font-semibold text-gray-700 dark:text-white">92.6%</p>
                    <p class="text-sm text-green-500">
                        <span class="font-medium">+2.3%</span> dari bulan lalu
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        <!-- Grafik Produksi Bulanan -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Produksi Bulanan</h3>
                <div>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="chartTimeDropdown"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-800 border border-gray-200 dark:border-gray-600"
                        type="button">
                        Tahun 2023
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="chartTimeDropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tahun
                                    2023</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tahun
                                    2022</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tahun
                                    2021</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="relative">
                <canvas id="productionChart" height="300"></canvas>
            </div>
        </div>

        <!-- Pengiriman Akan Datang -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pengiriman Akan Datang</h3>
                <a href=""
                    class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Lihat Semua</a>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path
                                            d="M19.9 6.58c0-.009 0-.019-.006-.027l-2-4A1 1 0 0 0 17 2h-4a1 1 0 0 0 0 2h2.52l1.654 3.307a5.543 5.543 0 0 0-1.138 1.307c-.32.504-.54 1.1-.656 1.71-.155.096-.32.186-.458.29a5.56 5.56 0 0 0-2.991-.96L11.596 7H9.336a1 1 0 0 0-.707.293L6.586 9.335a1 1 0 0 0 0 1.414l3.05 3.049a1 1 0 0 0 .707.293h4.318l1.134 2.265a1 1 0 0 0 .446.447A.978.978 0 0 0 16.73 17a1 1 0 0 0 .894-1.447L16.707 14h.383a2.98 2.98 0 0 0 2.144-.894 2.94 2.94 0 0 0 .667-3.084A2.98 2.98 0 0 0 19.9 6.58Z" />
                                        <path
                                            d="M4.065 10.664a1.002 1.002 0 0 0-.758.336L.835 13.47a1 1 0 1 0 1.414 1.414l1.818-1.818 2.525 1.262a1 1 0 0 0 1.449-.448l.571-1.142-3.03-3.03-1.517.956Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    PT Bangun Perkasa
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    35 m³ Beton K-350
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Hari
                                    Ini</span>
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path
                                            d="M19.9 6.58c0-.009 0-.019-.006-.027l-2-4A1 1 0 0 0 17 2h-4a1 1 0 0 0 0 2h2.52l1.654 3.307a5.543 5.543 0 0 0-1.138 1.307c-.32.504-.54 1.1-.656 1.71-.155.096-.32.186-.458.29a5.56 5.56 0 0 0-2.991-.96L11.596 7H9.336a1 1 0 0 0-.707.293L6.586 9.335a1 1 0 0 0 0 1.414l3.05 3.049a1 1 0 0 0 .707.293h4.318l1.134 2.265a1 1 0 0 0 .446.447A.978.978 0 0 0 16.73 17a1 1 0 0 0 .894-1.447L16.707 14h.383a2.98 2.98 0 0 0 2.144-.894 2.94 2.94 0 0 0 .667-3.084A2.98 2.98 0 0 0 19.9 6.58Z" />
                                        <path
                                            d="M4.065 10.664a1.002 1.002 0 0 0-.758.336L.835 13.47a1 1 0 1 0 1.414 1.414l1.818-1.818 2.525 1.262a1 1 0 0 0 1.449-.448l.571-1.142-3.03-3.03-1.517.956Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    PT Maju Bersama
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    50 m³ Beton K-250
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <span
                                    class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Besok</span>
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path
                                            d="M19.9 6.58c0-.009 0-.019-.006-.027l-2-4A1 1 0 0 0 17 2h-4a1 1 0 0 0 0 2h2.52l1.654 3.307a5.543 5.543 0 0 0-1.138 1.307c-.32.504-.54 1.1-.656 1.71-.155.096-.32.186-.458.29a5.56 5.56 0 0 0-2.991-.96L11.596 7H9.336a1 1 0 0 0-.707.293L6.586 9.335a1 1 0 0 0 0 1.414l3.05 3.049a1 1 0 0 0 .707.293h4.318l1.134 2.265a1 1 0 0 0 .446.447A.978.978 0 0 0 16.73 17a1 1 0 0 0 .894-1.447L16.707 14h.383a2.98 2.98 0 0 0 2.144-.894 2.94 2.94 0 0 0 .667-3.084A2.98 2.98 0 0 0 19.9 6.58Z" />
                                        <path
                                            d="M4.065 10.664a1.002 1.002 0 0 0-.758.336L.835 13.47a1 1 0 1 0 1.414 1.414l1.818-1.818 2.525 1.262a1 1 0 0 0 1.449-.448l.571-1.142-3.03-3.03-1.517.956Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    PT Konstruksi Utama
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    75 m³ Beton K-300
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">18
                                    Okt</span>
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path
                                            d="M19.9 6.58c0-.009 0-.019-.006-.027l-2-4A1 1 0 0 0 17 2h-4a1 1 0 0 0 0 2h2.52l1.654 3.307a5.543 5.543 0 0 0-1.138 1.307c-.32.504-.54 1.1-.656 1.71-.155.096-.32.186-.458.29a5.56 5.56 0 0 0-2.991-.96L11.596 7H9.336a1 1 0 0 0-.707.293L6.586 9.335a1 1 0 0 0 0 1.414l3.05 3.049a1 1 0 0 0 .707.293h4.318l1.134 2.265a1 1 0 0 0 .446.447A.978.978 0 0 0 16.73 17a1 1 0 0 0 .894-1.447L16.707 14h.383a2.98 2.98 0 0 0 2.144-.894 2.94 2.94 0 0 0 .667-3.084A2.98 2.98 0 0 0 19.9 6.58Z" />
                                        <path
                                            d="M4.065 10.664a1.002 1.002 0 0 0-.758.336L.835 13.47a1 1 0 1 0 1.414 1.414l1.818-1.818 2.525 1.262a1 1 0 0 0 1.449-.448l.571-1.142-3.03-3.03-1.517.956Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    PT Gedung Tinggi
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    100 m³ Beton K-400
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">20
                                    Okt</span>
                            </div>
                        </div>
                    </li>
                    <li class="pt-3 pb-0 sm:pt-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path
                                            d="M19.9 6.58c0-.009 0-.019-.006-.027l-2-4A1 1 0 0 0 17 2h-4a1 1 0 0 0 0 2h2.52l1.654 3.307a5.543 5.543 0 0 0-1.138 1.307c-.32.504-.54 1.1-.656 1.71-.155.096-.32.186-.458.29a5.56 5.56 0 0 0-2.991-.96L11.596 7H9.336a1 1 0 0 0-.707.293L6.586 9.335a1 1 0 0 0 0 1.414l3.05 3.049a1 1 0 0 0 .707.293h4.318l1.134 2.265a1 1 0 0 0 .446.447A.978.978 0 0 0 16.73 17a1 1 0 0 0 .894-1.447L16.707 14h.383a2.98 2.98 0 0 0 2.144-.894 2.94 2.94 0 0 0 .667-3.084A2.98 2.98 0 0 0 19.9 6.58Z" />
                                        <path
                                            d="M4.065 10.664a1.002 1.002 0 0 0-.758.336L.835 13.47a1 1 0 1 0 1.414 1.414l1.818-1.818 2.525 1.262a1 1 0 0 0 1.449-.448l.571-1.142-3.03-3.03-1.517.956Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    PT Sejahtera Abadi
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    45 m³ Beton K-300
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">22
                                    Okt</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        <!-- Distribusi Produksi Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 dark:text-white">Distribusi Produk</h3>
            <div class="relative">
                <canvas id="productDistributionChart" height="260"></canvas>
            </div>
        </div>

        <!-- Stok Bahan Baku -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Stok Bahan Baku</h3>
                <a href=""
                    class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Kelola Stok</a>
            </div>
            <div class="space-y-4">
                <!-- Semen -->
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-white">Semen</span>
                        <span class="text-sm font-medium text-gray-700 dark:text-white">68%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: 68%"></div>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400">180 ton tersisa</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">dari 250 ton</span>
                    </div>
                </div>

                <!-- Pasir -->
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-white">Pasir</span>
                        <span class="text-sm font-medium text-gray-700 dark:text-white">45%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-yellow-400 h-2.5 rounded-full" style="width: 45%"></div>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400">122 ton tersisa</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">dari 300 ton</span>
                    </div>
                </div>

                <!-- Kerikil -->
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-white">Kerikil</span>
                        <span class="text-sm font-medium text-gray-700 dark:text-white">82%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-green-500 h-2.5 rounded-full" style="width: 82%"></div>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400">205 ton tersisa</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">dari 250 ton</span>
                    </div>
                </div>

                <!-- Aditif -->
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-white">Aditif</span>
                        <span class="text-sm font-medium text-orange-500 dark:text-orange-400">22%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-orange-500 h-2.5 rounded-full" style="width: 22%"></div>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400">220 liter tersisa</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">dari 1,000 liter</span>
                    </div>
                </div>

                <!-- Air -->
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-white">Air</span>
                        <span class="text-sm font-medium text-gray-700 dark:text-white">95%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-300 h-2.5 rounded-full" style="width: 95%"></div>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400">19,000 liter tersisa</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">dari 20,000 liter</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ketersediaan Armada -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Status Armada</h3>
                <a href=""
                    class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Kelola Armada</a>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-green-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex justify-center mb-2">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 text-green-500 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-300">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">8</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Supir Tersedia</p>
                    </div>
                </div>
                <div class="bg-blue-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex justify-center mb-2">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-900 dark:text-blue-300">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M15.97 10.28a.997.997 0 0 0-.027-.32l-2.625-4.25a1 1 0 0 0-.352-.355l-9.94-6a1 1 0 0 0-1.414 1.344L4.077 4H3a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h1.586l-.828.5a1.003 1.003 0 0 0 0 1.414L6.07 14.414A1 1 0 0 0 7 14h5.617l1.934 3.647a1 1 0 0 0 1.531.207l3.857-3.924a1 1 0 0 0 .03-1.35l-4-4a.997.997 0 0 0-.031-.027Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">12</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Mixer Tersedia</p>
                    </div>
                </div>
                <div class="bg-purple-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex justify-center mb-2">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 text-purple-500 bg-purple-100 rounded-lg dark:bg-purple-900 dark:text-purple-300">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M19.949 9.011a1 1 0 0 0-.472-.796l-3.493-2.155V2a1 1 0 0 0-1-1H5.015a1 1 0 0 0-1 1v4.06L.531 8.196a1.001 1.001 0 0 0-.52.917A.998.998 0 0 0 .97 10h3.936l-3.868 7a1 1 0 0 0 .129 1.092c.293.33.712.482 1.132.391.23-.05.436-.17.58-.347L6.707 14h6.586l3.893 4.136c.144.177.35.296.58.347.42.09.839-.062 1.132-.391a.999.999 0 0 0 .129-1.092l-3.937-7h3.937a.998.998 0 0 0 .959-.887c.016-.041.025-.083.033-.126-.003-.001-.006.001-.07-.046Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">4</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Pompa Tersedia</p>
                    </div>
                </div>
                <div class="bg-red-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex justify-center mb-2">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 text-red-500 bg-red-100 rounded-lg dark:bg-red-900 dark:text-red-300">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M19.607 6.995a1 1 0 0 0-.783-.976l-5-1.3a1 1 0 0 0-1.118.702l-.981 3.41a1 1 0 0 0 .971 1.28h3.175l-3.432 3.141a1 1 0 0 0 0 1.483l3.432 3.141H12.7a1 1 0 0 0-.97 1.279l.981 3.411a1 1 0 0 0 .968.79 1.09 1.09 0 0 0 .15-.011l5-1.3a1 1 0 0 0 .783-.976v-4.872l2.184-2.183a1.041 1.041 0 0 0 0-1.483L19.607 11.9v-4.905Z" />
                                <path
                                    d="M8 18H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h7.151a2.03 2.03 0 0 1-.151.773L7.94 9.483A2.843 2.843 0 0 1 5.5 9 3.5 3.5 0 1 0 9 12.5a2.848 2.848 0 0 1-.483 2.44l-.457.559H8Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">3</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Dalam Perbaikan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Pesanan Terbaru -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pesanan Terbaru</h3>
                <a href=""
                    class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">ID Pesanan</th>
                            <th scope="col" class="px-4 py-3">Pelanggan</th>
                            <th scope="col" class="px-4 py-3">Tanggal</th>
                            <th scope="col" class="px-4 py-3">Produk</th>
                            <th scope="col" class="px-4 py-3">Total</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                #ORD-2023-1852
                            </th>
                            <td class="px-4 py-3">PT Bangun Perkasa</td>
                            <td class="px-4 py-3">17 Okt 2023</td>
                            <td class="px-4 py-3">Beton K-350</td>
                            <td class="px-4 py-3">Rp 35,000,000</td>
                            <td class="px-4 py-3"><span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Lunas</span>
                            </td>
                        </tr>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                #ORD-2023-1851
                            </th>
                            <td class="px-4 py-3">PT Maju Bersama</td>
                            <td class="px-4 py-3">16 Okt 2023</td>
                            <td class="px-4 py-3">Beton K-250</td>
                            <td class="px-4 py-3">Rp 42,500,000</td>
                            <td class="px-4 py-3"><span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Menunggu
                                    Pembayaran</span></td>
                        </tr>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                #ORD-2023-1850
                            </th>
                            <td class="px-4 py-3">PT Konstruksi Utama</td>
                            <td class="px-4 py-3">15 Okt 2023</td>
                            <td class="px-4 py-3">Beton K-300</td>
                            <td class="px-4 py-3">Rp 68,250,000</td>
                            <td class="px-4 py-3"><span
                                    class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Dalam
                                    Proses</span></td>
                        </tr>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                #ORD-2023-1849
                            </th>
                            <td class="px-4 py-3">PT Gedung Tinggi</td>
                            <td class="px-4 py-3">14 Okt 2023</td>
                            <td class="px-4 py-3">Beton K-400</td>
                            <td class="px-4 py-3">Rp 92,000,000</td>
                            <td class="px-4 py-3"><span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Lunas</span>
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                #ORD-2023-1848
                            </th>
                            <td class="px-4 py-3">PT Sejahtera Abadi</td>
                            <td class="px-4 py-3">13 Okt 2023</td>
                            <td class="px-4 py-3">Beton K-300</td>
                            <td class="px-4 py-3">Rp 38,250,000</td>
                            <td class="px-4 py-3"><span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Lunas</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Log Aktivitas -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Log Aktivitas</h3>
                <a href=""
                    class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Lihat Semua</a>
            </div>
            <ol class="relative border-l border-gray-200 dark:border-gray-700">
                <li class="mb-6 ml-4">
                    <div
                        class="absolute w-3 h-3 bg-blue-600 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-blue-500">
                    </div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Baru saja</time>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Pengiriman #DEL-2023-0458 selesai</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Supir Budi telah menyelesaikan pengiriman ke PT
                        Bangun Perkasa</p>
                </li>
                <li class="mb-6 ml-4">
                    <div
                        class="absolute w-3 h-3 bg-blue-600 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-blue-500">
                    </div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">20 menit yang
                        lalu</time>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Pesanan #ORD-2023-1853 dibuat</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Ahmad membuat pesanan baru dari PT Jaya Konstruksi
                    </p>
                </li>
                <li class="mb-6 ml-4">
                    <div
                        class="absolute w-3 h-3 bg-blue-600 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-blue-500">
                    </div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">45 menit yang
                        lalu</time>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Pembayaran #INV-2023-0987 diterima</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Pembayaran Rp 35,000,000 dari PT Bangun Perkasa
                        telah dikonfirmasi</p>
                </li>
                <li class="mb-6 ml-4">
                    <div
                        class="absolute w-3 h-3 bg-blue-600 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-blue-500">
                    </div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">2 jam yang
                        lalu</time>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Maintenance pompa #P003 selesai</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Tim maintenance telah menyelesaikan perbaikan pompa
                        #P003</p>
                </li>
                <li class="mb-6 ml-4">
                    <div
                        class="absolute w-3 h-3 bg-blue-600 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-blue-500">
                    </div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">4 jam yang
                        lalu</time>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Stok semen mendekati batas minimum</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Sistem secara otomatis membuat permintaan pengisian
                        stok semen</p>
                </li>
                <li class="ml-4">
                    <div
                        class="absolute w-3 h-3 bg-blue-600 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-blue-500">
                    </div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">6 jam yang
                        lalu</time>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Hasil uji kuat tekan batch #B2023-456
                        selesai</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Hasil uji kuat tekan menunjukkan nilai 37.5 MPa,
                        memenuhi standar K-350</p>
                </li>
            </ol>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Grafik Produksi Bulanan
        const productionCtx = document.getElementById('productionChart').getContext('2d');
        const productionChart = new Chart(productionCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Produksi (m³)',
                    data: [450, 520, 610, 580, 630, 740, 820, 790, 875, 750, 0, 0],
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(156, 163, 175, 0.1)'
                        },
                        ticks: {
                            color: document.documentElement.classList.contains('dark') ?
                                'rgba(255, 255, 255, 0.7)' : 'rgba(55, 65, 81, 0.7)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: document.documentElement.classList.contains('dark') ?
                                'rgba(255, 255, 255, 0.7)' : 'rgba(55, 65, 81, 0.7)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Distribusi Produk
        const productDistributionCtx = document.getElementById('productDistributionChart').getContext('2d');
        const productDistributionChart = new Chart(productDistributionCtx, {
            type: 'doughnut',
            data: {
                labels: ['K-250', 'K-300', 'K-350', 'K-400', 'K-500'],
                datasets: [{
                    data: [25, 35, 20, 15, 5],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            padding: 15,
                            color: document.documentElement.classList.contains('dark') ?
                                'rgba(255, 255, 255, 0.7)' : 'rgba(55, 65, 81, 0.7)'
                        }
                    }
                }
            }
        });

        // Ubah warna chart saat mode gelap diubah
        document.addEventListener('dark-mode', function(e) {
            const isDark = e.detail.isDark;

            // Produksi Bulanan
            productionChart.options.scales.y.ticks.color = isDark ? 'rgba(255, 255, 255, 0.7)' :
                'rgba(55, 65, 81, 0.7)';
            productionChart.options.scales.x.ticks.color = isDark ? 'rgba(255, 255, 255, 0.7)' :
                'rgba(55, 65, 81, 0.7)';
            productionChart.update();

            // Distribusi Produk
            productDistributionChart.options.plugins.legend.labels.color = isDark ? 'rgba(255, 255, 255, 0.7)' :
                'rgba(55, 65, 81, 0.7)';
            productDistributionChart.update();
        });
    </script>
@endpush

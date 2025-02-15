<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Qalcuity ERP') }}</title>
    <meta name="description"
        content="Qalcuity ERP adalah solusi manajemen bisnis terpadu untuk perusahaan modern. Tingkatkan efisiensi operasional dan produktivitas bisnis Anda.">
    <meta name="keywords" content="ERP, Enterprise Resource Planning, Manajemen Bisnis, Software Bisnis, Qalcuity">
    <link rel="icon" type="image/x-icon" href="{{ asset('dist/img/2.png') }}">

    <!-- Modern Sans-serif Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        .hexagon-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0l25.98 15v30L30 60 4.02 45V15z' fill-opacity='.05' fill='%234B88E5'/%3E%3C/svg%3E");
            background-size: 60px 60px;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-blue-100 to-white dark:from-gray-900 dark:to-blue-900 hexagon-bg">
        <!-- Sidebar Navigation -->
        <div class="fixed left-0 top-0 h-full w-64 bg-blue-800 dark:bg-gray-900 shadow-lg">
            <!-- Welcome Message -->
            <div class="p-6 border-b border-blue-700 dark:border-gray-800">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . Auth::user()->gambar) }}" alt="Profile"
                        class="h-12 w-12 rounded-full border-2 border-white">
                    <div>
                        <h1 class="text-lg font-semibold text-white">Selamat Datang,</h1>
                        <p class="text-blue-200 dark:text-gray-300">{{ Auth::user()->name }}</p>
                    </div>
                </div>
                <div class="mt-3 text-sm text-blue-200 dark:text-gray-400">
                    {{ \Carbon\Carbon::now()->format('l, d F Y') }}
                </div>
            </div>
            <!-- Navigation Menu -->
            @include('layouts.navigation')
        </div>

        <!-- Main Content -->
        <div class="ml-64">
            <!-- Top Header -->
            <header class="bg-white dark:bg-gray-900 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                    <!-- Location & IP Info -->
                    <div class="w-96 flex items-center space-x-6">
                        <div
                            class="flex items-center text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-medium">{{ request()->ip() }}</span>
                        </div>
                        <div
                            class="flex items-center text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                            </svg>
                            <span class="text-sm font-medium">Indonesia</span>
                        </div>
                        <a href="#"
                            class="flex items-center text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-medium">Docs</span>
                        </a>
                    </div>

                    <!-- User Menu & Notifications -->
                    <div class="flex items-center space-x-4">
                        <button
                            class="p-2 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                            {{-- <span class="text-sm font-medium">Notif</span> --}}
                        </button>

                        <button
                            class="flex items-center text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                            <a href="/" class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span class="text-sm font-medium">Home</span>
                            </a>
                        </button>

                        <div class="relative">
                            <button id="profileButton"
                                class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-all duration-200">
                                <img src="{{ asset('storage/' . Auth::user()->gambar) }}" alt="User"
                                    class="w-10 h-10 rounded-full border-2 border-blue-500 shadow-md">
                                <span
                                    class="text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">{{ Auth::user()->name }}</span>
                            </button>
                            <div id="profileDropdown"
                                class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 transform transition-all duration-200">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center space-x-3 p-4 text-left rounded-xl hover:bg-blue-50 dark:hover:bg-gray-700 transition-all duration-200">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        <span
                                            class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Logout</span>
                                    </button>
                                </form>
                            </div>
                            <script>
                                const profileButton = document.getElementById('profileButton');
                                const profileDropdown = document.getElementById('profileDropdown');

                                profileButton.addEventListener('click', () => {
                                    profileDropdown.classList.toggle('hidden');
                                });

                                document.addEventListener('click', (event) => {
                                    if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                                        profileDropdown.classList.add('hidden');
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>

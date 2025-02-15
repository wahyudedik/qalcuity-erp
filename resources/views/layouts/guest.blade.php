<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description"
        content="Qalcuity ERP adalah solusi manajemen bisnis terpadu untuk perusahaan modern. Tingkatkan efisiensi operasional dan produktivitas bisnis Anda.">
    <meta name="keywords" content="ERP, Enterprise Resource Planning, Manajemen Bisnis, Software Bisnis, Qalcuity">
    <link rel="icon" type="image/x-icon" href="{{ asset('dist/img/2.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 to-blue-800 relative overflow-hidden">
        <!-- Animated Background Pattern -->
        <div class="absolute inset-0 bg-[url('/public/assets/grid.svg')] opacity-10 bg-repeat"></div>

        <!-- Main Content Container -->
        <div class="w-full sm:max-w-md p-8 backdrop-blur-xl bg-white/10 rounded-2xl shadow-2xl border border-white/20">
            <!-- Logo Section -->
            {{-- <div class="flex justify-center mb-8">
                <div class="p-2 rounded-full bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-white" />
                        {{-- <img src="{{ asset('dist/img/2.png') }}" alt="Logo"  --}}
                        {{-- class="w-20 h-20 rounded"> --}}
                    </a>
                </div>
            </div> --}}

            <!-- Content Slot -->
            <div class="overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>

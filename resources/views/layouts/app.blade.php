<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Qalcuity ERP') }} - @yield('title', 'Dashboard')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')
</head>

<body class="flex h-screen overflow-hidden bg-gray-100 dark:bg-gray-900">
    <!-- Alpine.js data -->
    <div x-data="{ 
            sidebarCollapsed: window.innerWidth < 768 ? true : (localStorage.getItem('sidebarCollapsed') === 'true'), 
            rightSidebarOpen: false,
            get showModuleNav() { 
                return $store.moduleState.activeModule !== null 
            }
        }" 
        x-init="
            $watch('sidebarCollapsed', (value) => {
                localStorage.setItem('sidebarCollapsed', value);
            });
            window.addEventListener('resize', () => {
                if (window.innerWidth < 768 && !sidebarCollapsed) {
                    sidebarCollapsed = true;
                }
            });
        "
        class="flex w-full h-full">
        
        <!-- Left module navigation (conditionally shown) -->
        <div x-show="showModuleNav" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             :class="{'w-64': !sidebarCollapsed, 'w-0': sidebarCollapsed}"
             class="fixed md:relative z-30 h-full overflow-y-auto bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-all duration-300">
            
            <!-- Close button for mobile -->
            <button @click="sidebarCollapsed = true" 
                class="md:hidden absolute top-4 right-4 text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Dynamically include the module navigation based on active module -->
            <div x-show="$store.moduleState.activeModule === 'branch'">
                @include('Modul.branch.layouts.nav-branch')
            </div>
            
            <div x-show="$store.moduleState.activeModule === 'user'">
                @include('Modul.auth.users.layouts.nav-user')
            </div>
            
            <!-- Add more module navigations as needed -->
            <!-- Example: -->
            <!-- <div x-show="$store.moduleState.isModuleActive('finance')">
                {{-- @include('Modul.finance.layouts.nav-finance') --}}
            </div> -->
        </div>

        <!-- Overlay for mobile when sidebar is open -->
        <div x-show="showModuleNav && !sidebarCollapsed" 
             @click="sidebarCollapsed = true"
             class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden">
        </div>

        <!-- Main content wrapper -->
        <div class="flex flex-col flex-1 h-full">
            @include('components.header')

            <!-- Main scrollable area -->
            <main class="flex-1 overflow-x-auto overflow-y-auto">
                <div class="container p-3 md:p-4 mx-auto">
                    <!-- Flash Messages -->
                    @if (session()->has('success'))
                        <div id="alert-success"
                            class="flex p-3 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                            role="alert" x-data="{ show: true }" x-show="show" x-transition>
                            <svg class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div class="ml-3 text-sm font-medium">{{ session('success') }}</div>
                            <button type="button" @click="show = false"
                                class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-6 w-6 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700">
                                <span class="sr-only">Close</span>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div id="alert-error"
                            class="flex p-3 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800"
                            role="alert" x-data="{ show: true }" x-show="show" x-transition>
                            <svg class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div class="ml-3 text-sm font-medium">{{ session('error') }}</div>
                            <button type="button" @click="show = false"
                                class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-6 w-6 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700">
                                <span class="sr-only">Close</span>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    @endif

                    <!-- Module navigation indicator if active -->
                    <div x-show="$store.moduleState.activeModule !== null" class="mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 mr-2">Modul Aktif:</span>
                                <span class="text-xs font-semibold text-blue-600 dark:text-blue-400" x-text="$store.moduleState.activeModule === 'branch' ? 'Cabang' : $store.moduleState.activeModule"></span>
                            </div>
                            <button 
                                @click="$store.moduleState.clearActiveModule(); showModuleNav = false; window.location.href = '{{ route('dashboard') }}';" 
                                class="text-xs text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-400">
                                Keluar Modul
                            </button>
                        </div>
                    </div>

                    <!-- Breadcrumb and titles -->
                    @hasSection('breadcrumb')
                        <div class="mb-4">@yield('breadcrumb')</div>
                    @endif

                    @hasSection('page-title')
                        <div class="mb-4">
                            <h1 class="text-xl font-semibold text-gray-900 dark:text-white">@yield('page-title')</h1>
                            @hasSection('page-subtitle')
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">@yield('page-subtitle')</p>
                            @endif
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>

            @include('components.footer')
        </div>

        <!-- Right module sidebar -->
        @include('components.module-sidebar')

        <!-- Modal container -->
        <div id="modal-container"></div>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>

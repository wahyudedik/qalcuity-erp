<header class="sticky top-0 z-30 flex items-center w-full h-12 bg-white shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-between w-full px-3">
        <div class="flex items-center">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center ml-2">
                <img src="{{ asset('img/favicon.png') }}" class="h-6 mr-2" alt="Qalcuity Logo" />
                <span class="self-center text-xs font-semibold whitespace-nowrap dark:text-white">Qalcuity ERP</span>
            </a>

            <!-- Breadcrumb - Desktop only -->
            <nav class="hidden md:flex ml-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-xs">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    @yield('breadcrumb-items')
                </ol>
            </nav>
        </div>

        <!-- Right Side Actions -->
        <div class="flex items-center space-x-1">
            <!-- Search -->
            <div class="hidden md:block relative mr-2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                    <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="global-search" class="block w-full p-1.5 pl-8 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari...">
            </div>

            <!-- Module Sidebar Toggle -->
            <button @click="rightSidebarOpen = !rightSidebarOpen" type="button"
                class="p-1.5 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:outline-none">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span class="sr-only">Modul</span>
            </button>

            <!-- Notifications -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="relative p-1.5 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                    <span class="sr-only">Lihat notifikasi</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 14 20">
                        <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                    </svg>
                    @php
                        $unreadCount = auth()->check() ? auth()->user()->unreadNotifications()->count() : 0;
                    @endphp
                    @if ($unreadCount > 0)
                        <div class="absolute inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -right-1 dark:border-gray-900">
                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                        </div>
                    @endif
                </button>

                <!-- Notification dropdown -->
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 z-10 mt-1 overflow-hidden bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-80 dark:bg-gray-700 dark:divide-gray-600"
                    x-transition>
                    <div class="block px-4 py-2 text-xs font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        Notifikasi
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700 max-h-64 overflow-y-auto">
                        @if (auth()->check() && auth()->user()->notifications->count() > 0)
                            @foreach (auth()->user()->notifications()->take(5)->get() as $notification)
                                <div class="notification-item {{ $notification->read_at ? 'bg-white dark:bg-gray-800' : 'bg-blue-50 dark:bg-gray-700' }}">
                                    <a href="#" data-notification-id="{{ $notification->id }}" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <div class="flex-shrink-0">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-full pl-3">
                                            <div class="text-xs font-semibold text-gray-900 dark:text-white">
                                                {{ $notification->data['title'] ?? 'Notifikasi Baru' }}
                                            </div>
                                            <div class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                {{ $notification->data['message'] ?? 'Anda memiliki notifikasi baru' }}
                                            </div>
                                            <span class="text-xs font-normal text-blue-600 dark:text-blue-500">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="px-4 py-3 text-xs text-center text-gray-500 dark:text-gray-400">
                                Tidak ada notifikasi baru
                            </div>
                        @endif
                    </div>
                    <a href="#" id="mark-all-read"
                        class="block py-2 text-xs font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                        Tandai semua telah dibaca
                    </a>
                </div>
            </div>

            <!-- Dark mode toggle -->
            <button id="theme-toggle" type="button"
                class="p-1.5 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>

            <!-- User menu -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" type="button"
                    class="flex text-sm bg-gray-800 rounded-full focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-7 h-7 rounded-full"
                        src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7F9CF5&background=EBF4FF&size=30' }}"
                        alt="user photo">
                </button>
                
                <!-- Dropdown menu -->
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 z-50 mt-1 text-xs list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    x-transition>
                    <div class="px-4 py-2">
                        <span class="block text-xs text-gray-900 dark:text-white">{{ auth()->user()->name }}</span>
                        <span class="block text-xs text-gray-500 truncate dark:text-gray-400">{{ auth()->user()->email }}</span>
                    </div>
                    <ul class="py-1">
                        <li>
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Profil Saya
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Pengaturan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();" 
                               class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Logout
                            </a>
                            <form id="logout-form-header" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

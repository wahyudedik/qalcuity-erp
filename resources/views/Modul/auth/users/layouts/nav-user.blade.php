<div class="p-3 md:p-4">
    <div class="flex items-center mb-3 md:mb-4">
        <div class="p-1.5 md:p-2 rounded-lg bg-orange-100 dark:bg-orange-900 mr-2 md:mr-3">
            <svg class="w-5 h-5 md:w-6 md:h-6 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
        </div>
        <h2 class="text-base md:text-lg font-semibold text-gray-900 dark:text-white">Manajemen Pengguna</h2>
    </div>

    <nav class="space-y-0.5 md:space-y-1">
        <a href="{{ route('users.index') }}" 
           class="{{ request()->routeIs('users.index') ? 'bg-orange-50 text-orange-700 dark:bg-gray-700 dark:text-orange-400' : 'text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700' }} group flex items-center px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-sm font-medium rounded-md">
            <svg class="mr-2 md:mr-3 flex-shrink-0 h-4 w-4 md:h-5 md:w-5 {{ request()->routeIs('users.index') ? 'text-orange-500 dark:text-orange-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400' }}" 
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
            </svg>
            <span class="truncate">Daftar Pengguna</span>
        </a>
        
        <a href="{{ route('users.create') }}" 
           class="{{ request()->routeIs('users.create') ? 'bg-orange-50 text-orange-700 dark:bg-gray-700 dark:text-orange-400' : 'text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700' }} group flex items-center px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-sm font-medium rounded-md">
            <svg class="mr-2 md:mr-3 flex-shrink-0 h-4 w-4 md:h-5 md:w-5 {{ request()->routeIs('users.create') ? 'text-orange-500 dark:text-orange-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400' }}" 
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span class="truncate">Tambah Pengguna</span>
        </a>
        
        @if(auth()->user()->is_admin ?? false)
        <a href="#" 
           class="{{ request()->routeIs('roles.index') ? 'bg-orange-50 text-orange-700 dark:bg-gray-700 dark:text-orange-400' : 'text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700' }} group flex items-center px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-sm font-medium rounded-md">
            <svg class="mr-2 md:mr-3 flex-shrink-0 h-4 w-4 md:h-5 md:w-5 {{ request()->routeIs('roles.index') ? 'text-orange-500 dark:text-orange-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400' }}" 
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                </path>
            </svg>
            <span class="truncate">Manajemen Peran</span>
        </a>

        <a href="#" 
           class="{{ request()->routeIs('permissions.index') ? 'bg-orange-50 text-orange-700 dark:bg-gray-700 dark:text-orange-400' : 'text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700' }} group flex items-center px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-sm font-medium rounded-md">
            <svg class="mr-2 md:mr-3 flex-shrink-0 h-4 w-4 md:h-5 md:w-5 {{ request()->routeIs('permissions.index') ? 'text-orange-500 dark:text-orange-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400' }}" 
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                </path>
            </svg>
            <span class="truncate">Izin Akses</span>
        </a>
        @endif
    </nav>

    <div class="mt-6 md:mt-8 pt-4 md:pt-6 border-t border-gray-200 dark:border-gray-700">
        <h3 class="px-2 md:px-3 text-2xs md:text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">
            Fitur Pengguna
        </h3>
        <div class="mt-1 md:mt-2 space-y-0.5 md:space-y-1">
            <a href="{{ route('profile.show') }}" 
               class="{{ request()->routeIs('profile.show') ? 'bg-orange-50 text-orange-700 dark:bg-gray-700 dark:text-orange-400' : 'text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700' }} group flex items-center px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-sm font-medium rounded-md">
                <svg class="mr-2 md:mr-3 flex-shrink-0 h-4 w-4 md:h-5 md:w-5 {{ request()->routeIs('profile.show') ? 'text-orange-500 dark:text-orange-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400' }}" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                    </path>
                </svg>
                <span class="truncate">Profil Saya</span>
            </a>
            
            <a href="#" 
               class="text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700 group flex items-center px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-sm font-medium rounded-md">
                <svg class="mr-2 md:mr-3 flex-shrink-0 h-4 w-4 md:h-5 md:w-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                    </path>
                </svg>
                <span class="truncate">Pengaturan Akun</span>
            </a>
            
            <a href="#" 
               class="text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700 group flex items-center px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-sm font-medium rounded-md">
                <svg class="mr-2 md:mr-3 flex-shrink-0 h-4 w-4 md:h-5 md:w-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
                <span class="truncate">Keamanan</span>
            </a>
        </div>
    </div>
</div>
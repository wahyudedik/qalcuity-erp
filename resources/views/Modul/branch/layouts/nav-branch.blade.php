<div class="p-3 md:p-4">
    <div class="flex items-center mb-4">
        <div class="p-2 rounded-lg bg-teal-100 dark:bg-teal-900 mr-2 md:mr-3">
            <svg class="w-5 h-5 md:w-6 md:h-6 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                </path>
            </svg>
        </div>
        <h2 class="text-base md:text-lg font-semibold text-gray-900 dark:text-white">Manajemen Cabang</h2>
    </div>

    <nav class="space-y-1 text-sm">
        <a href="{{ route('branches.index') }}" 
           class="{{ request()->routeIs('branches.index') ? 'bg-teal-50 text-teal-700 dark:bg-gray-700 dark:text-teal-400' : 'text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md">
            <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->routeIs('branches.index') ? 'text-teal-500 dark:text-teal-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400' }}" 
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Daftar Cabang
        </a>
        
        <a href="{{ route('branches.create') }}" 
           class="{{ request()->routeIs('branches.create') ? 'bg-teal-50 text-teal-700 dark:bg-gray-700 dark:text-teal-400' : 'text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md">
            <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->routeIs('branches.create') ? 'text-teal-500 dark:text-teal-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400' }}" 
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tambah Cabang
        </a>
        
        <a href="{{ route('branches.reports') }}" 
           class="{{ request()->routeIs('branches.reports') ? 'bg-teal-50 text-teal-700 dark:bg-gray-700 dark:text-teal-400' : 'text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md">
            <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->routeIs('branches.reports') ? 'text-teal-500 dark:text-teal-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400' }}" 
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Laporan Cabang
        </a>
    </nav>

    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">
            Cabang Aktif
        </h3>
        <div class="mt-2 space-y-1">
            <!-- Dynamic list of branches user has access to -->
            @if(auth()->user()->branches->count() > 0)
                @foreach(auth()->user()->branches as $branch)
                    <a href="{{ route('branches.switch', $branch) }}" 
                        class="{{ session('active_branch_id') == $branch->id ? 'bg-teal-50 text-teal-700 dark:bg-gray-700 dark:text-teal-400' : 'text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                        <span class="truncate">{{ $branch->name }}</span>
                        @if(session('active_branch_id') == $branch->id)
                            <svg class="ml-2 h-4 w-4 text-teal-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </a>
                @endforeach
            @else
                <div class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                    Tidak ada cabang aktif
                </div>
            @endif
        </div>
    </div>
</div>
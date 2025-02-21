<nav class="flex flex-col h-full">
    <!-- Main Navigation -->
    <div class="flex-1 px-2 sm:px-4 py-2 space-y-1">
        <!-- Dashboard Link -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-2 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-green-600 text-white' : 'text-white hover:bg-blue-700/60 transition-colors' }}">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="whitespace-nowrap">Dashboard</span>
        </a>

        <!-- Settings -->
        <a href="{{ route('profile.edit') }}"
            class="flex items-center px-2 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm font-medium rounded-lg {{ request()->routeIs('profile.edit') ? 'bg-green-600 text-white' : 'text-white hover:bg-blue-700/60 transition-colors' }}">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="whitespace-nowrap">Settings</span>
        </a>

        <!-- User Profile Section -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center w-full px-2 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm font-medium text-white rounded-lg hover:bg-blue-700/60 transition-colors">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="whitespace-nowrap">Logout</span>
            </button>
        </form>
    </div>
</nav>

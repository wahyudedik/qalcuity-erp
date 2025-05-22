<div id="notification-dropdown" class="z-20 hidden max-h-[80vh] overflow-y-auto w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-800 dark:divide-gray-700">
    <div class="block px-4 py-2 font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-800 dark:text-white">
        Notifikasi
        <span class="inline-flex items-center justify-center px-2 py-1 ml-2 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:bg-red-900 dark:text-red-200">
            {{ auth()->user()->unreadNotifications()->count() }}
        </span>
    </div> 
    <div class="divide-y divide-gray-100 dark:divide-gray-700">
        @forelse(auth()->user()->notifications()->take(5)->get() as $notification)
            <div class="notification-item {{ $notification->read_at ? 'bg-white dark:bg-gray-800' : 'bg-blue-50 dark:bg-gray-700' }}">
                <a href="#" data-notification-id="{{ $notification->id }}" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex-shrink-0">
                        @switch($notification->data['type'] ?? 'info')
                            @case('success')
                                <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @break
                            @case('warning')
                                <div class="w-8 h-8 rounded-full bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @break
                            @case('error')
                                <div class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @break
                            @default
                                <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                                    </svg>
                                </div>
                        @endswitch
                    </div>
                    <div class="w-full pl-3">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $notification->data['title'] ?? 'Notifikasi Baru' }}
                        </div>
                        <div class="text-xs font-normal text-gray-500 dark:text-gray-400">
                            {{ $notification->data['message'] ?? 'Anda memiliki notifikasi baru' }}
                        </div>
                        <span class="text-xs font-normal text-blue-600 dark:text-blue-500">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <button type="button" data-notification-id="{{ $notification->id }}" class="mark-read-btn ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1 hover:bg-gray-100 inline-flex h-6 w-6 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">
                        <span class="sr-only">Mark as read</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </a>
            </div>
        @empty
            <div class="px-4 py-3 text-sm text-center text-gray-500 dark:text-gray-400">
                Tidak ada notifikasi baru
            </div>
        @endforelse
    </div>
    <a href="#" id="mark-all-read" class="block py-2 text-sm font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
        Tandai semua telah dibaca
    </a>
    <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
        Lihat semua notifikasi
    </a>
</div>
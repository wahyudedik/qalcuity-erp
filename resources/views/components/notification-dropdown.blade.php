<div id="notification-dropdown" class="z-50 hidden max-h-[70vh] overflow-y-auto w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700" aria-labelledby="notification-dropdown-button">
    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
        Notifikasi
    </div>
    <div class="divide-y divide-gray-100 dark:divide-gray-700">
        @php
            $notifications = auth()->user()->notifications()->take(10)->get();
        @endphp
        
        @forelse($notifications as $notification)
            @php
                $data = $notification->data;
                $isRead = $notification->read_at !== null;
                $icon = $data['icon'] ?? 'default';
            @endphp
            <div class="notification-item {{ $isRead ? 'bg-white' : 'bg-blue-50' }} dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                <a href="{{ route('notifications.download', $notification->id) }}" class="flex px-4 py-3" data-notification-id="{{ $notification->id }}">
                    <div class="flex-shrink-0">
                        @if($icon === 'pdf')
                            <div class="rounded-full w-11 h-11 flex items-center justify-center bg-red-100 dark:bg-red-900">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4.5 2A1.5 1.5 0 0 0 3 3.5v13A1.5 1.5 0 0 0 4.5 18h11a1.5 1.5 0 0 0 1.5-1.5V7.621a1.5 1.5 0 0 0-.44-1.06l-4.12-4.122A1.5 1.5 0 0 0 11.378 2H4.5zm2.25 7.5a.75.75 0 0 1 .75-.75h5a.75.75 0 0 1 0 1.5h-5a.75.75 0 0 1-.75-.75zm0 3a.75.75 0 0 1 .75-.75h5a.75.75 0 0 1 0 1.5h-5a.75.75 0 0 1-.75-.75z"/>
                                </svg>
                            </div>
                        @elseif($icon === 'excel')
                            <div class="rounded-full w-11 h-11 flex items-center justify-center bg-green-100 dark:bg-green-900">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                                    <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                                    <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
                                </svg>
                            </div>
                        @elseif($icon === 'error')
                            <div class="rounded-full w-11 h-11 flex items-center justify-center bg-red-100 dark:bg-red-900">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                                </svg>
                            </div>
                        @else
                            <div class="rounded-full w-11 h-11 flex items-center justify-center bg-blue-100 dark:bg-blue-900">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.546l3.2 3.659a.5.5 0 0 0 .753 0L12.7 14H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-8 10H5a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Zm5-4H5a1 1 0 0 1 0-2h10a1 1 0 1 1 0 2Z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="w-full pl-3">
                        <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">{{ $data['message'] }}</div>
                        <div class="text-xs text-blue-600 dark:text-blue-500">
                            {{ \Carbon\Carbon::parse($data['time'])->diffForHumans() }}
                        </div>
                    </div>
                </a>
                <button class="mark-read-btn absolute top-3 right-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" 
                        data-notification-id="{{ $notification->id }}" title="Tandai sebagai dibaca">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @empty
            <div class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                <div class="w-full text-center py-4 text-sm text-gray-500 dark:text-gray-400">
                    Tidak ada notifikasi
                </div>
            </div>
        @endforelse
    </div>
    
    <a href="#" id="mark-all-read" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
        <div class="inline-flex items-center">
            <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
            </svg>
            Tandai Semua Dibaca
        </div>
    </a>
</div>
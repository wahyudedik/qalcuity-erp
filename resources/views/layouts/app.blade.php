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

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')
</head>

<body class="bg-gray-50 dark:bg-gray-900">

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Content Wrapper -->
    <div class="flex flex-col md:pl-64">
        @include('components.header')

        <!-- Main Content -->
        <main class="p-4 md:p-6 h-auto min-h-screen">
            <!-- Breadcrumb -->
            @hasSection('breadcrumb')
                <div class="mb-6">
                    @yield('breadcrumb')
                </div>
            @endif

            <!-- Page Title -->
            @hasSection('page-title')
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">@yield('page-title')</h1>
                    @hasSection('page-subtitle')
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">@yield('page-subtitle')</p>
                    @endif
                </div>
            @endif

            <!-- Flash Messages -->
            @if (session()->has('success'))
                <div id="alert-success"
                    class="flex p-4 mb-6 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                    role="alert">
                    <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div class="ml-3 text-sm font-medium">{{ session('success') }}</div>
                    <button type="button"
                        class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-success" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif

            @if (session()->has('error'))
                <div id="alert-error"
                    class="flex p-4 mb-6 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800"
                    role="alert">
                    <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div class="ml-3 text-sm font-medium">{{ session('error') }}</div>
                    <button type="button"
                        class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-error" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </main>

        @include('components.footer')
    </div>

    <!-- Modal container for dynamic modals -->
    <div id="modal-container"></div>

    <!-- Scripts -->
    @stack('scripts')

    <script>
        // Initialize Flowbite
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const content = document.querySelector('.md\\:pl-64');
            const closeSidebarButton = document.getElementById('close-sidebar');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                });
            }

            // Tambahkan tombol close sidebar di mobile
            if (closeSidebarButton) {
                closeSidebarButton.addEventListener('click', function() {
                    sidebar.classList.add('-translate-x-full');
                });
            }

            // Tutup sidebar saat klik di luar sidebar pada mode mobile
            document.addEventListener('click', function(event) {
                const isMobile = window.innerWidth < 768; // md breakpoint is 768px
                if (isMobile && sidebar && !sidebar.contains(event.target) &&
                    event.target !== sidebarToggle && !sidebarToggle.contains(event.target)) {
                    sidebar.classList.add('-translate-x-full');
                }
            });

            // Close alert functionality
            const dismissButtons = document.querySelectorAll('[data-dismiss-target]');
            dismissButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const targetId = button.getAttribute('data-dismiss-target');
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.remove();
                    }
                });
            });

            // Handle notification mark as read
            document.addEventListener('click', function(e) {
                // Check if we clicked on a notification item or its child elements
                const notificationItem = e.target.closest('.notification-item a');
                if (notificationItem) {
                    const notificationId = notificationItem.getAttribute('data-notification-id');
                    markNotificationAsRead(notificationId);
                }

                // Check if we clicked on a mark read button
                const markReadBtn = e.target.closest('.mark-read-btn');
                if (markReadBtn) {
                    e.preventDefault();
                    e.stopPropagation();
                    const notificationId = markReadBtn.getAttribute('data-notification-id');
                    markNotificationAsRead(notificationId);

                    // Remove the item from display or mark it as read visually
                    const item = markReadBtn.closest('.notification-item');
                    if (item) {
                        item.classList.remove('bg-blue-50');
                        item.classList.add('bg-white');
                    }
                }

                // Handle mark all as read
                const markAllReadBtn = e.target.closest('#mark-all-read');
                if (markAllReadBtn) {
                    e.preventDefault();
                    markAllNotificationsAsRead();
                }
            });

            // Function to mark notification as read
            function markNotificationAsRead(id) {
                fetch(`/notifications/mark-as-read/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update notification count
                            updateNotificationCount();
                        }
                    })
                    .catch(error => console.error('Error marking notification as read:', error));
            }

            // Function to mark all notifications as read
            function markAllNotificationsAsRead() {
                fetch('/notifications/mark-all-read', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update UI
                            document.querySelectorAll('.notification-item').forEach(item => {
                                item.classList.remove('bg-blue-50');
                                item.classList.add('bg-white');
                            });

                            // Reset notification badge
                            updateNotificationCount(0);
                        }
                    })
                    .catch(error => console.error('Error marking all notifications as read:', error));
            }

            // Function to update notification count
            function updateNotificationCount(count = null) {
                const badge = document.querySelector('[data-dropdown-toggle="notification-dropdown"] .bg-red-500');

                if (count === 0 || count === null && badge) {
                    // If count is explicitly 0 or we just marked something as read, update the UI
                    if (count === 0) {
                        // Remove badge completely if count is 0
                        if (badge) badge.remove();
                    } else {
                        // Decrement badge count
                        let currentCount = parseInt(badge.textContent);
                        if (currentCount > 1) {
                            badge.textContent = currentCount > 10 ? '9+' : (currentCount - 1);
                        } else {
                            badge.remove();
                        }
                    }
                }
            }

            // Listen for real-time notifications if Echo is configured
            if (window.Echo && typeof window.Echo.private === 'function') {
                @if (auth()->check())
                    window.Echo.private('user.{{ auth()->id() }}')
                        .listen('ReportGeneratedEvent', (e) => {
                            // Reload the notification dropdown content or update it with JS
                            // For simplicity, we'll just reload the page after a short delay
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        });
                @endif
            }
        });
    </script>
</body>

</html>

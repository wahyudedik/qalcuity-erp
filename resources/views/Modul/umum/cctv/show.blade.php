@extends('layouts.app')

@section('content')
    <div name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $camera->name }}
            </h2>
            <div>
                <a href="{{ route('cameras.index') }}"
                    class="px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to List') }}
                </a>
                <a href="{{ route('cameras.edit', $camera->id) }}"
                    class="ml-2 px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit Camera') }}
                </a>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Camera Status Bar -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-600 flex justify-between items-center">
                    <div class="flex items-center">
                        <span id="camera-status"
                            class="px-3 py-1 rounded-full text-sm font-medium {{ $camera->status === 'online' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : ($camera->status === 'maintenance' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300') }}">
                            {{ ucfirst($camera->status) }}
                        </span>
                        <span class="ml-2 text-gray-600 dark:text-gray-300">Last updated: <span
                                id="last-updated">{{ now()->format('M d, Y H:i:s') }}</span></span>
                    </div>
                    <button id="check-connection" data-camera-id="{{ $camera->id }}"
                        class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Check Connection') }}
                    </button>
                </div>

                <!-- Camera Stream -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2 p-6">
                        <div class="relative bg-black rounded-lg overflow-hidden" style="height: 480px;">
                            @if ($camera->status === 'online')
                                <div id="camera-stream-container" class="w-full h-full">
                                    <!-- This is where the camera feed will be displayed -->
                                    <img id="camera-stream"
                                        src="https://via.placeholder.com/1280x720.png?text=CCTV+Live+Feed" alt="CCTV Stream"
                                        class="w-full h-full object-contain">
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center bg-gray-800 w-full h-full">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="mt-3 text-gray-400 text-lg">Camera Offline</p>
                                    <p class="mt-1 text-gray-500 text-sm">The camera is currently not available.</p>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 flex justify-center space-x-4">
                            <button id="fullscreen-btn"
                                class="px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5">
                                    </path>
                                </svg>
                                Fullscreen
                            </button>
                            <button id="snapshot-btn"
                                class="px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Snapshot
                            </button>
                        </div>
                    </div>

                    <!-- Camera Details -->
                    <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Camera Details</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Name</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $camera->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Location</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $camera->location }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">IP Address</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $camera->ip_address }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Port</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $camera->port }}</p>
                            </div>
                            @if ($camera->branch)
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Branch</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $camera->branch->name }}</p>
                                </div>
                            @endif
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Description</p>
                                <p class="font-medium text-gray-900 dark:text-white">
                                    {{ $camera->description ?: 'No description provided' }}</p>
                            </div>
                        </div>

                        <div class="mt-6 border-t border-gray-200 dark:border-gray-600 pt-4">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Recent Activity</h4>
                            <div class="space-y-2">
                                @forelse($camera->accessLogs()->latest()->take(5)->get() as $log)
                                    <div class="text-xs text-gray-600 dark:text-gray-300">
                                        <span class="font-medium">{{ $log->user->name }}</span>
                                        <span>{{ $log->action }}</span>
                                        <span class="text-gray-400">{{ $log->accessed_at->diffForHumans() }}</span>
                                    </div>
                                @empty
                                    <p class="text-xs text-gray-500 dark:text-gray-400">No recent activity</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Recent Recordings -->
                        <div class="mt-6 border-t border-gray-200 dark:border-gray-600 pt-4">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Recent Recordings</h4>
                            <div class="space-y-2">
                                @forelse($camera->recordings()->latest()->take(5)->get() as $recording)
                                    <div class="flex justify-between items-center text-xs">
                                        <span
                                            class="text-gray-600 dark:text-gray-300">{{ $recording->start_time->format('M d, Y H:i') }}</span>
                                        <a href="#"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                                    </div>
                                @empty
                                    <p class="text-xs text-gray-500 dark:text-gray-400">No recordings available</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cameraId = "{{ $camera->id }}";
            const checkConnectionBtn = document.getElementById('check-connection');
            const cameraStatus = document.getElementById('camera-status');
            const lastUpdated = document.getElementById('last-updated');
            const cameraStream = document.getElementById('camera-stream');
            const cameraStreamContainer = document.getElementById('camera-stream-container');
            const fullscreenBtn = document.getElementById('fullscreen-btn');
            const snapshotBtn = document.getElementById('snapshot-btn');

            // Function to update camera status
            function updateCameraStatus() {
                checkConnectionBtn.innerHTML =
                    '<svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

                fetch(`/cameras/${cameraId}/check-connection`)
                    .then(response => response.json())
                    .then(data => {
                        checkConnectionBtn.textContent = 'Check Connection';
                        lastUpdated.textContent = new Date().toLocaleString();

                        // Update status display
                        cameraStatus.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                        cameraStatus.className = 'px-3 py-1 rounded-full text-sm font-medium';

                        if (data.status === 'online') {
                            cameraStatus.classList.add('bg-green-100', 'text-green-800', 'dark:bg-green-900',
                                'dark:text-green-300');
                            // Refresh the camera stream if it's now online
                            if (cameraStreamContainer) {
                                cameraStreamContainer.innerHTML =
                                    `<img id="camera-stream" src="https://via.placeholder.com/1280x720.png?text=CCTV+Live+Feed&t=${new Date().getTime()}" alt="CCTV Stream" class="w-full h-full object-contain">`;
                            }
                        } else if (data.status === 'maintenance') {
                            cameraStatus.classList.add('bg-yellow-100', 'text-yellow-800', 'dark:bg-yellow-900',
                                'dark:text-yellow-300');
                            showOfflineMessage('Camera Under Maintenance',
                                'The camera is currently undergoing maintenance.');
                        } else {
                            cameraStatus.classList.add('bg-red-100', 'text-red-800', 'dark:bg-red-900',
                                'dark:text-red-300');
                            showOfflineMessage('Camera Offline', 'The camera is currently not available.');
                        }
                    })
                    .catch(error => {
                        console.error('Error checking camera status:', error);
                        checkConnectionBtn.textContent = 'Check Connection';
                    });
            }

            // Function to show offline message
            function showOfflineMessage(title, message) {
                if (cameraStreamContainer) {
                    cameraStreamContainer.innerHTML = `
                    <div class="flex flex-col items-center justify-center bg-gray-800 w-full h-full">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <p class="mt-3 text-gray-400 text-lg">${title}</p>
                        <p class="mt-1 text-gray-500 text-sm">${message}</p>
                    </div>
                `;
                }
            }

            // Check connection button
            if (checkConnectionBtn) {
                checkConnectionBtn.addEventListener('click', updateCameraStatus);
            }

            // Fullscreen functionality
            if (fullscreenBtn && cameraStreamContainer) {
                fullscreenBtn.addEventListener('click', function() {
                    if (cameraStreamContainer.requestFullscreen) {
                        cameraStreamContainer.requestFullscreen();
                    } else if (cameraStreamContainer.webkitRequestFullscreen) {
                        /* Safari */
                        cameraStreamContainer.webkitRequestFullscreen();
                    } else if (cameraStreamContainer.msRequestFullscreen) {
                        /* IE11 */
                        cameraStreamContainer.msRequestFullscreen();
                    }
                });
            }

            // Snapshot functionality
            if (snapshotBtn && cameraStream) {
                snapshotBtn.addEventListener('click', function() {
                    if (cameraStream) {
                        // Create a canvas element
                        const canvas = document.createElement('canvas');
                        canvas.width = cameraStream.naturalWidth || cameraStream.width;
                        canvas.height = cameraStream.naturalHeight || cameraStream.height;

                        // Draw the image on the canvas
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(cameraStream, 0, 0, canvas.width, canvas.height);

                        // Convert to data URL and download
                        try {
                            const dataUrl = canvas.toDataURL('image/png');
                            const downloadLink = document.createElement('a');
                            downloadLink.href = dataUrl;
                            downloadLink.download =
                                `camera-${cameraId}-snapshot-${new Date().toISOString().replace(/:/g, '-')}.png`;
                            document.body.appendChild(downloadLink);
                            downloadLink.click();
                            document.body.removeChild(downloadLink);
                        } catch (e) {
                            console.error('Error taking snapshot:', e);
                            alert(
                                'Could not take snapshot. The camera may be offline or the feed is from an external source.');
                        }
                    }
                });
            }

            // Auto-refresh status every 30 seconds
            const statusInterval = setInterval(updateCameraStatus, 30000);

            // Clean up interval when leaving the page
            window.addEventListener('beforeunload', function() {
                clearInterval(statusInterval);
            });
        });
    </script>
@endpush

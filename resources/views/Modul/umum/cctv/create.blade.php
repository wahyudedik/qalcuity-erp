@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Add New Camera') }}
            </h2>
            <a href="{{ route('cameras.index') }}"
                class="px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Form -->
                <form action="{{ route('cameras.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Name -->
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Camera Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                                <input type="text" name="location" id="location" value="{{ old('location') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required>
                                @error('location')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- IP Address -->
                            <div>
                                <label for="ip_address"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">IP Address</label>
                                <input type="text" name="ip_address" id="ip_address" value="{{ old('ip_address') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required>
                                @error('ip_address')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Port -->
                            <div>
                                <label for="port"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Port</label>
                                <input type="number" name="port" id="port" value="{{ old('port', '80') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required>
                                @error('port')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Username -->
                            <div>
                                <label for="username"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username (if
                                    required)</label>
                                <input type="text" name="username" id="username" value="{{ old('username') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @error('username')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password (if
                                    required)</label>
                                <input type="password" name="password" id="password" value="{{ old('password') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- RTSP URL -->
                            <div>
                                <label for="rtsp_url"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">RTSP URL
                                    (Optional)</label>
                                <input type="text" name="rtsp_url" id="rtsp_url" value="{{ old('rtsp_url') }}"
                                    placeholder="rtsp://example.com/stream"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @error('rtsp_url')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- HTTP URL -->
                            <div>
                                <label for="http_url"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">HTTP URL
                                    (Optional)</label>
                                <input type="text" name="http_url" id="http_url" value="{{ old('http_url') }}"
                                    placeholder="http://example.com/stream"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @error('http_url')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select name="status" id="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="online" {{ old('status') === 'online' ? 'selected' : '' }}>Online
                                    </option>
                                    <option value="offline" {{ old('status') === 'offline' ? 'selected' : '' }}>Offline
                                    </option>
                                    <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>
                                        Maintenance</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Branch -->
                            <div>
                                <label for="branch_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Branch</label>
                                <select name="branch_id" id="branch_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <textarea name="description" id="description" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Active Status -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="is_active" name="is_active" type="checkbox" value="1"
                                        {{ old('is_active', '1') ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_active"
                                        class="font-medium text-gray-700 dark:text-gray-300">Active</label>
                                    <p class="text-gray-500 dark:text-gray-400">Enable this camera in the system
                                        immediately after creation.</p>
                                </div>
                                @error('is_active')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Quick Connection Test -->
                    <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Test Connection (Optional)
                            </h3>
                            <button type="button" id="test-connection"
                                class="px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Test Connection
                            </button>
                        </div>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Verify if the camera is accessible with
                            the provided details.</p>

                        <div id="connection-result" class="mt-3 hidden">
                            <!-- Results will be displayed here -->
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 mt-8">
                        <a href="{{ route('cameras.index') }}"
                            class="px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Add Camera
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const ipInput = document.getElementById('ip_address');
            const portInput = document.getElementById('port');
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const testConnectionButton = document.getElementById('test-connection');
            const connectionResult = document.getElementById('connection-result');

            // IP address validation
            ipInput.addEventListener('blur', function() {
                const ipRegex =
                    /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
                if (this.value && !ipRegex.test(this.value)) {
                    this.setCustomValidity('Please enter a valid IP address');
                } else {
                    this.setCustomValidity('');
                }
            });

            // Port validation
            portInput.addEventListener('blur', function() {
                const port = parseInt(this.value, 10);
                if (isNaN(port) || port < 1 || port > 65535) {
                    this.setCustomValidity('Please enter a valid port number (1-65535)');
                } else {
                    this.setCustomValidity('');
                }
            });

            // Test connection
            if (testConnectionButton) {
                testConnectionButton.addEventListener('click', function() {
                    const ip = ipInput.value;
                    const port = portInput.value;
                    const username = usernameInput.value;
                    const password = passwordInput.value;

                    if (!ip || !port) {
                        alert('Please enter IP address and port number to test the connection.');
                        return;
                    }

                    // Show loading indicator
                    connectionResult.innerHTML = `
            <div class="flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-blue-500">Testing connection...</span>
            </div>
        `;
                    connectionResult.classList.remove('hidden');

                    // Make AJAX request to test connection
                    fetch('/cameras/test-connection', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                ip_address: ip,
                                port: port,
                                username: username,
                                password: password
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                connectionResult.innerHTML = `
                    <div class="flex items-center text-green-600">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Connection successful! Camera is accessible.</span>
                    </div>
                `;

                                // Auto-set status to online
                                document.getElementById('status').value = 'online';
                            } else {
                                connectionResult.innerHTML = `
                    <div class="flex items-center text-red-600">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>Connection failed: ${data.message}</span>
                    </div>
                `;

                                // Suggest setting status to offline
                                document.getElementById('status').value = 'offline';
                            }
                        })
                        .catch(error => {
                            connectionResult.innerHTML = `
                <div class="flex items-center text-red-600">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span>Error testing connection. Please try again.</span>
                </div>
            `;
                            console.error('Error:', error);
                        });
                });
            }

            // Auto-generate RTSP URL based on IP, port, username, password
            function updateRtspUrl() {
                const ip = ipInput.value;
                const port = portInput.value;
                const username = usernameInput.value;
                const password = passwordInput.value;
                const rtspInput = document.getElementById('rtsp_url');

                if (ip && port) {
                    let rtspUrl = 'rtsp://';
                    if (username && password) {
                        rtspUrl += `${username}:${password}@`;
                    }
                    rtspUrl += `${ip}:${port}/stream`;

                    // Only update if the field is empty or was previously auto-generated
                    if (!rtspInput.value || rtspInput.dataset.autoGenerated === 'true') {
                        rtspInput.value = rtspUrl;
                        rtspInput.dataset.autoGenerated = 'true';
                    }
                }
            }

            // Listen for changes to auto-generate RTSP URL
            ipInput.addEventListener('change', updateRtspUrl);
            portInput.addEventListener('change', updateRtspUrl);
            usernameInput.addEventListener('change', updateRtspUrl);
            passwordInput.addEventListener('change', updateRtspUrl);
        });
    </script>
@endpush

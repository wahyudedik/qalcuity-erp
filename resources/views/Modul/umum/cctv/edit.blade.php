@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Camera') }}: {{ $camera->name }}
            </h2>
            <div>
                <a href="{{ route('cameras.index') }}"
                    class="px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to List') }}
                </a>
                <a href="{{ route('cameras.show', $camera->id) }}"
                    class="ml-2 px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('View Camera') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Form -->
                <form action="{{ route('cameras.update', $camera->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Name -->
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Camera Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $camera->name) }}"
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
                                <input type="text" name="location" id="location"
                                    value="{{ old('location', $camera->location) }}"
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
                                <input type="text" name="ip_address" id="ip_address"
                                    value="{{ old('ip_address', $camera->ip_address) }}"
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
                                <input type="number" name="port" id="port"
                                    value="{{ old('port', $camera->port) }}"
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
                                <input type="text" name="username" id="username"
                                    value="{{ old('username', $camera->username) }}"
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
                                <input type="password" name="password" id="password"
                                    value="{{ old('password', $camera->password) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave blank to keep current
                                    password.</p>
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
                                <input type="text" name="rtsp_url" id="rtsp_url"
                                    value="{{ old('rtsp_url', $camera->rtsp_url) }}"
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
                                <input type="text" name="http_url" id="http_url"
                                    value="{{ old('http_url', $camera->http_url) }}"
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
                                    <option value="online"
                                        {{ old('status', $camera->status) === 'online' ? 'selected' : '' }}>Online</option>
                                    <option value="offline"
                                        {{ old('status', $camera->status) === 'offline' ? 'selected' : '' }}>Offline
                                    </option>
                                    <option value="maintenance"
                                        {{ old('status', $camera->status) === 'maintenance' ? 'selected' : '' }}>
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
                                            {{ old('branch_id', $camera->branch_id) == $branch->id ? 'selected' : '' }}>
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
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $camera->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Active Status -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="is_active" name="is_active" type="checkbox" value="1"
                                        {{ old('is_active', $camera->is_active) ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_active"
                                        class="font-medium text-gray-700 dark:text-gray-300">Active</label>
                                    <p class="text-gray-500 dark:text-gray-400">Enable or disable this camera in the
                                        system.</p>
                                </div>
                                @error('is_active')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
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
                            Update Camera
                        </button>
                    </div>
                </form>

                <!-- Delete Camera Form -->
                <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-600">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-medium text-red-600 dark:text-red-400">Danger Zone</h3>
                        <form action="{{ route('cameras.destroy', $camera->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this camera? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Delete Camera
                            </button>
                        </form>
                    </div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Once you delete a camera, all of its resources and data will be permanently deleted. Before deleting
                        this camera, please download any data or information that you wish to retain.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Connection test functionality could be added here
            const ipInput = document.getElementById('ip_address');
            const portInput = document.getElementById('port');
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');

            // Example of a simple IP address validation
            ipInput.addEventListener('blur', function() {
                const ipRegex =
                    /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
                if (this.value && !ipRegex.test(this.value)) {
                    this.setCustomValidity('Please enter a valid IP address');
                } else {
                    this.setCustomValidity('');
                }
            });

            // Example of port validation
            portInput.addEventListener('blur', function() {
                const port = parseInt(this.value, 10);
                if (isNaN(port) || port < 1 || port > 65535) {
                    this.setCustomValidity('Please enter a valid port number (1-65535)');
                } else {
                    this.setCustomValidity('');
                }
            });
        });
    </script>
@endpush

@extends('layouts.app')

@section('content')
<div name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('CCTV Monitoring') }}
        </h2>
        <div>
            <a href="{{ route('cameras.create') }}" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Add Camera') }}
            </a>
            <button id="checkAllConnections" class="px-4 py-2 ml-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Check All Status') }}
            </button>
        </div>
    </div>
</div>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            <!-- Filter Form -->
            <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <form method="GET" action="{{ route('cameras.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                        <input type="text" id="location" name="location" value="{{ $filters['location'] ?? '' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">All Statuses</option>
                            <option value="online" {{ isset($filters['status']) && $filters['status'] === 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ isset($filters['status']) && $filters['status'] === 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="maintenance" {{ isset($filters['status']) && $filters['status'] === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
                    <div>
                        <label for="branch_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
                        <select id="branch_id" name="branch_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">All Branches</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ isset($filters['branch_id']) && $filters['branch_id'] == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Filter</button>
                        <a href="{{ route('cameras.index') }}" class="ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Reset</a>
                    </div>
                </form>
            </div>
            
            <!-- CCTV Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($cameras as $camera)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden shadow-md">
                        <div class="p-4 border-b border-gray-200 dark:border-gray-600 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $camera->name }}</h3>
                            <span class="camera-status px-2.5 py-0.5 rounded-full text-xs font-medium {{ $camera->status === 'online' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : ($camera->status === 'maintenance' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300') }}">
                                {{ ucfirst($camera->status) }}
                            </span>
                        </div>
                        <div class="relative bg-black h-48 flex items-center justify-center">
                            @if($camera->status === 'online')
                                <img src="https://via.placeholder.com/640x360.png?text=CCTV+Preview" alt="CCTV Preview" class="w-full h-full object-cover">
                            @else
                                <div class="flex flex-col items-center justify-center bg-gray-800 w-full h-full">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="mt-2 text-gray-400 text-sm">Camera Offline</p>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                                <strong>Location:</strong> {{ $camera->location }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                                <strong>IP:</strong> {{ $camera->ip_address }}:{{ $camera->port }}
                            </p>
                            <div class="flex justify-between">
                                <div>
                                    <a href="{{ route('cameras.show', $camera->id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">
                                        View
                                    </a>
                                    <a href="{{ route('cameras.edit', $camera->id) }}" class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300 mr-2">
                                        Edit
                                    </a>
                                </div>
                                <button data-camera-id="{{ $camera->id }}" class="check-connection text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                                    Check Status
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 p-6 text-center">
                        <p class="text-gray-500 dark:text-gray-400">No cameras found. Add a camera to start monitoring.</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $cameras->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Individual camera status check
        const checkButtons = document.querySelectorAll('.check-connection');
        checkButtons.forEach(button => {
            button.addEventListener('click', function() {
                const cameraId = this.getAttribute('data-camera-id');
                this.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
                
                fetch(`/cameras/${cameraId}/check-connection`)
                    .then(response => response.json())
                    .then(data => {
                        // Update camera status in the UI
                        const statusElement = this.closest('.bg-gray-50').querySelector('.camera-status');
                        this.innerHTML = 'Check Status';
                        
                        // Update the status indicator
                        statusElement.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                        statusElement.className = 'camera-status px-2.5 py-0.5 rounded-full text-xs font-medium';
                        
                        if (data.status === 'online') {
                            statusElement.classList.add('bg-green-100', 'text-green-800', 'dark:bg-green-900', 'dark:text-green-300');
                        } else if (data.status === 'maintenance') {
                            statusElement.classList.add('bg-yellow-100', 'text-yellow-800', 'dark:bg-yellow-900', 'dark:text-yellow-300');
                        } else {
                            statusElement.classList.add('bg-red-100', 'text-red-800', 'dark:bg-red-900', 'dark:text-red-300');
                        }
                    })
                    .catch(error => {
                        console.error('Error checking camera status:', error);
                        this.innerHTML = 'Error';
                        setTimeout(() => {
                            this.innerHTML = 'Check Status';
                        }, 2000);
                    });
            });
        });
        
        // Check all connections
        const checkAllButton = document.getElementById('checkAllConnections');
        if (checkAllButton) {
            checkAllButton.addEventListener('click', function() {
                this.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
                
                fetch('/cameras-check-all-connections')
                    .then(response => response.json())
                    .then(data => {
                        this.innerHTML = 'Check All Status';
                        
                        // Update the UI for each camera
                        if (data.success && data.results) {
                            Object.keys(data.results).forEach(cameraId => {
                                const result = data.results[cameraId];
                                const cameraElements = document.querySelectorAll(`[data-camera-id="${cameraId}"]`);
                                
                                if (cameraElements.length > 0) {
                                    const statusElement = cameraElements[0].closest('.bg-gray-50').querySelector('.camera-status');
                                    
                                    if (statusElement) {
                                        statusElement.textContent = result.current_status.charAt(0).toUpperCase() + result.current_status.slice(1);
                                        statusElement.className = 'camera-status px-2.5 py-0.5 rounded-full text-xs font-medium';
                                        
                                        if (result.current_status === 'online') {
                                            statusElement.classList.add('bg-green-100', 'text-green-800', 'dark:bg-green-900', 'dark:text-green-300');
                                        } else if (result.current_status === 'maintenance') {
                                            statusElement.classList.add('bg-yellow-100', 'text-yellow-800', 'dark:bg-yellow-900', 'dark:text-yellow-300');
                                        } else {
                                            statusElement.classList.add('bg-red-100', 'text-red-800', 'dark:bg-red-900', 'dark:text-red-300');
                                        }
                                    }
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error checking all cameras:', error);
                        this.innerHTML = 'Error';
                        setTimeout(() => {
                            this.innerHTML = 'Check All Status';
                        }, 2000);
                    });
            });
        }
    });
</script>
@endpush

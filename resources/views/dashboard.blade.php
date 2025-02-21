<x-app-layout>
    <div class="space-y-6">
        <!-- Dashboard Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-900 dark:text-white">Business Overview</h1>
            <button onclick="openModal('addTenantModal')"
                class="flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Business
            </button>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 border border-blue-100 dark:border-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Businesses</p>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $tenantStats['total'] }}
                        </h3>
                    </div>
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/50 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Business List -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-blue-100 dark:border-gray-800">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Your Businesses</h2>
                    <div class="flex space-x-2">

                        <!-- sort input -->
                        <select
                            onchange="window.location.href='?sort=' + this.value + '&search=' + document.querySelector('input[name=search]').value"
                            class="rounded-lg border-gray-200 dark:border-gray-700 text-sm">
                            <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="active" {{ $sort === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $sort === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>

                        {{-- Search Bar --}}
                        <div class="relative">
                            <input type="text" name="search" value="{{ $search ?? '' }}"
                                onchange="window.location.href='?sort={{ $sort }}&search=' + this.value"
                                placeholder="Search businesses..."
                                class="w-64 rounded-lg border-gray-200 dark:border-gray-700 text-sm pl-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($tenants as $tenant)
                        <div
                            class="group relative bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center">
                                        <span class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                            {{ substr($tenant->name, 0, 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $tenant->name }}
                                    </p>
                                    <div class="flex items-center mt-1">
                                        <span
                                            class="px-2.5 py-0.5 text-xs font-medium {{ $tenant->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-400' }} rounded-full">
                                            {{ strtoupper($tenant->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link href="http://{{ $tenant->domain }}/home" target="_blank">
                                                Open
                                            </x-dropdown-link>

                                            <x-dropdown-link href="#"
                                                onclick="openModal('editTenantModal-{{ $tenant->id }}')">
                                                Edit
                                            </x-dropdown-link>

                                            <form action="{{ route('tenant.destroy', $tenant->id) }}" method="POST"
                                                class="mt-2">
                                                @csrf
                                                @method('DELETE')
                                                <x-dropdown-link href="#"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    Delete
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Tenant Modal -->
                        <div id="editTenantModal-{{ $tenant->id }}"
                            class="fixed inset-0 z-50 hidden overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen p-4">
                                <!-- Modal Backdrop -->
                                <div class="fixed inset-0 bg-black opacity-50"></div>

                                <!-- Modal Content -->
                                <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl">
                                    <!-- Modal Header -->
                                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Edit Business
                                        </h3>
                                        <button onclick="closeModal('editTenantModal-{{ $tenant->id }}')"
                                            class="text-gray-400 hover:text-gray-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Modal Body -->
                                    <form action="{{ route('tenant.update', $tenant->id) }}" method="POST"
                                        class="p-6">
                                        @csrf
                                        @method('patch')
                                        <div class="space-y-4">
                                            <!-- Business Name -->
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Business
                                                    Name</label>
                                                <input type="text" name="name" value="{{ $tenant->name }}"
                                                    required
                                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            </div>

                                            <!-- Domain -->
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Domain</label>
                                                <div class="mt-1 flex rounded-lg shadow-sm">
                                                    <span
                                                        class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300 sm:text-sm">
                                                        https://
                                                    </span>
                                                    <input type="text" name="domain"
                                                        value="{{ $tenant->domain }}" required
                                                        class="flex-1 block w-full rounded-none rounded-r-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500">
                                                </div>
                                            </div>

                                            {{-- database --}}
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Database
                                                    Name</label>
                                                <input type="text" name="database"
                                                    value="{{ $tenant->database }}" required
                                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                    readonly>
                                            </div>

                                            <!-- Status -->
                                            {{-- <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                                <select name="status"
                                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                    <option value="active"
                                                        {{ $tenant->status === 'active' ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="inactive"
                                                        {{ $tenant->status === 'inactive' ? 'selected' : '' }}>Inactive
                                                    </option>
                                                </select>
                                            </div> --}}
                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="mt-6 flex justify-end space-x-3">
                                            <button type="button"
                                                onclick="closeModal('editTenantModal-{{ $tenant->id }}')"
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Update Business
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <p class="text-gray-500 dark:text-gray-400">No businesses found.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $tenants->links() }}
                </div>
            </div>
        </div>

        <!-- Promotional Banner -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div class="space-y-4">
                    <h3 class="text-xl font-bold">Upgrade to Premium</h3>
                    <p class="text-blue-100 max-w-md">Get access to advanced features and unlimited business management
                        capabilities.</p>
                    <button
                        class="px-4 py-2 bg-white text-blue-600 rounded-lg font-medium hover:bg-blue-50 transition-colors">
                        Learn More
                    </button>
                </div>
                <div class="hidden lg:block">
                    <svg class="w-48 h-48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Tenant Modal -->
    <div id="addTenantModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- Modal Backdrop -->
            <div class="fixed inset-0 bg-black opacity-50"></div>

            <!-- Modal Content -->
            <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Add New Business
                    </h3>
                    <button onclick="closeModal('addTenantModal')" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <form action="{{ route('tenant.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-6">
                    @csrf
                    <div class="space-y-4">
                        <!-- Business Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Business
                                Name</label>
                            <input type="text" name="name" required
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Domain -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Domain</label>
                            <div class="mt-1 flex rounded-lg shadow-sm">
                                <span
                                    class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300 sm:text-sm">
                                    https://
                                </span>
                                <input type="text" name="domain" required
                                    class="flex-1 block w-full rounded-none rounded-r-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Database -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Database
                                Name</label>
                            <input type="text" name="database" required
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="closeModal('addTenantModal')"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Create Business
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>

    <!-- Success Message Toast -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-4 right-4 px-6 py-3 bg-green-600 text-white rounded-lg shadow-lg flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Error Message Toast -->
    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-4 right-4 px-6 py-3 bg-red-600 text-white rounded-lg shadow-lg flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

</x-app-layout>

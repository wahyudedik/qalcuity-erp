<x-app-layout>
    <div class="space-y-6">
        <!-- Dashboard Header with Tenant Stats -->
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
                    <form action="{{ route('tenants.store') }}" method="POST" enctype="multipart/form-data"
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

                            <!-- Address -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                <textarea name="alamat" rows="3" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone
                                    Number</label>
                                <input type="tel" name="no_hp" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Logo Upload -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Business Logo</label>
                                <div class="mt-1 flex items-center">
                                    <input type="file" name="gambar" accept="image/*"
                                        class="block w-full text-sm text-gray-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0
                          file:text-sm file:font-semibold
                          file:bg-blue-50 file:text-blue-700
                          hover:file:bg-blue-100">
                                </div>
                                @error('gambar')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select name="status" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
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

        <!-- Tenant Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Tenants Card -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 border border-blue-100 dark:border-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Businesses</p>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $tenants->count() }}</h3>
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

            <!-- Active Tenants -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 border border-blue-100 dark:border-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Active Businesses</p>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">
                            {{ $tenants->where('status', true)->count() }}
                        </h3>
                    </div>
                    <div class="p-3 bg-green-50 dark:bg-green-900/50 rounded-lg">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tenant List Section -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-blue-100 dark:border-gray-800">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Your Businesses</h2>
                    <div class="flex space-x-2">
                        <select id="statusFilter" class="rounded-lg border-gray-200 dark:border-gray-700 text-sm">
                            <option value="">All Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Tenant Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($tenants as $tenant)
                        <div
                            class="group relative bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @if ($tenant->gambar)
                                        <img src="{{ Storage::url($tenant->gambar) }}" alt="{{ $tenant->name }}"
                                            class="w-12 h-12 rounded-full object-cover">
                                    @else
                                        <div
                                            class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center">
                                            <span class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                                {{ substr($tenant->name, 0, 2) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $tenant->name }}
                                    </p>
                                    <div class="flex items-center mt-1">
                                        <span
                                            class="px-2.5 py-0.5 text-xs font-medium rounded-full {{ $tenant->status ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-400' }}">
                                            {{ $tenant->status ? 'ACTIVE' : 'INACTIVE' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open"
                                            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false"
                                            class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                                            <div class="py-1">
                                                <a href="{{ route('tenants.edit', $tenant) }}"
                                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Edit</a>
                                                <form action="{{ route('tenants.destroy', $tenant) }}" method="POST"
                                                    class="w-full">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">No businesses found. Create one to get started!
                            </p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $tenants->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

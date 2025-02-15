<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-blue-900 dark:text-white">Profile Settings</h1>
                <p class="mt-2 text-sm text-blue-600 dark:text-blue-400">Manage your account settings and preferences</p>
            </div>

            <!-- Profile Sections Grid -->
            <div class="grid gap-8">
                <!-- Profile Information -->
                <div
                    class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-blue-100 dark:border-blue-900/50">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-blue-900 dark:text-white mb-6">Profile Information</h2>
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Password Update -->
                <div
                    class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-blue-100 dark:border-blue-900/50">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-blue-900 dark:text-white mb-6">Update Password</h2>
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Delete Account -->
                <div
                    class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-blue-100 dark:border-blue-900/50">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-red-600 dark:text-red-400 mb-6">Delete Account</h2>
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Message Toast -->
            @if (session('status'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="fixed top-4 right-4 px-6 py-3 bg-green-600 text-white rounded-lg shadow-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('status') }}</span>
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

        </div>
    </div>
</x-app-layout>

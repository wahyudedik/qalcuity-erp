@extends('layouts.app')

@section('title', 'User Details')

@section('page-title', 'User Details')
@section('page-subtitle', 'View detailed user information')

@section('breadcrumb')
<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                </svg>
                Home
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                <a href="{{ route('users.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">User Management</a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ $user->name }}</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white dark:bg-gray-800">
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Profile Image Column -->
            <div class="md:col-span-1">
                <div class="flex flex-col items-center text-center">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full object-cover">
                    @else
                        <div class="relative w-32 h-32 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <svg class="absolute w-34 h-34 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <h5 class="mt-4 mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</span>
                    
                    <div class="mt-4">
                        <span class="px-3 py-1 text-xs font-semibold {{ $user->usertype === 'dev' ? 'text-red-800 bg-red-100 dark:bg-red-900 dark:text-red-300' : 'text-blue-800 bg-blue-100 dark:bg-blue-900 dark:text-blue-300' }} rounded-full">
                            {{ ucfirst($user->usertype) }}
                        </span>
                    </div>
                    
                    <div class="flex mt-6 space-x-3">
                        <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279"/>
                            </svg>
                            Edit
                        </a>
                        
                        @if(auth()->id() !== $user->id)
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- User Details Column -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">User Information</h3>
                
                <div class="grid grid-cols-1 gap-y-4">
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->name }}</p>
                    </div>
                    
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Username</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->username }}</p>
                    </div>
                    
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->email }}</p>
                    </div>
                    
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Role</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst($user->usertype) }}</p>
                    </div>
                    
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                    
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->updated_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>
                
                <!-- Activity or Additional Information Section -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Activity</h3>
                    
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Recent activity data will be displayed here when available.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('users.index') }}" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                    </svg>
                    Back to User List
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

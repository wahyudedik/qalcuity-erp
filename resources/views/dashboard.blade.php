@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome back, {{ Auth::user()->name }}!</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Here's what's happening with your ready-mix concrete plant today.</p>
    </div>

    @include('dashboard.partials_stats')
    
    @include('dashboard.partials_modules') 
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <div class="lg:col-span-2">
            @include('dashboard.partials_activities')
        </div>
        <div>
            @include('dashboard.partials_tasks')
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <div class="lg:col-span-2">
            @include('dashboard.partials_production_chart')
        </div>
        <div>
            @include('dashboard.partials_calendar')
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div>
            @include('dashboard.partials_inventory')
        </div>
        <div>
            @include('dashboard.partials_quick_links')
        </div>
    </div>
</div>
@endsection

<?php

use App\Models\Tenant;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'dev'])->group(function () {
    Route::get('/dev', [AuthController::class, 'login'])->name('dev.dashboard');
});

Route::middleware(['auth', 'verified', 'user_tenant'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'login'])->name('dashboard');

    // Tenant routes Profile
    Route::get('/dashboard/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/dashboard/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/dashboard/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tenant Route Create Database
    Route::post('/dashboard', [TenantController::class, 'store'])->name('tenant.store');
    Route::patch('/dashboard/{tenant}', [TenantController::class, 'update'])->name('tenant.update');
    Route::delete('/dashboard/{tenant}', [TenantController::class, 'destroy'])->name('tenant.destroy');
});

Route::middleware(['auth', 'verified', 'tenant'])->group(function () {
    Route::get('/home', function () {
        $user = Auth::user();
        $companies = Company::first();
        return view('tenant.index', compact('user', 'companies'));
    })->name('home');
});

require __DIR__ . '/auth.php';

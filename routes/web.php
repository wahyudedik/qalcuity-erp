<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Modul_Auth\LoginController;
use App\Http\Controllers\Modul_Auth\Forgot_Password_Controller;
use App\Http\Controllers\Modul_Auth\Reset_Password_Controller;
use App\Http\Controllers\Modul_Auth\Profile_Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Modul_Umum\Chat_Controller;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Forgot Password Routes
    Route::get('/forgot-password', [Forgot_Password_Controller::class, 'showForgotPasswordForm'])
        ->name('password.request');
    Route::post('/forgot-password', [Forgot_Password_Controller::class, 'sendResetLinkEmail'])
        ->name('password.email');

    // Reset Password Routes
    Route::get('/reset-password/{token}', [Reset_Password_Controller::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [Reset_Password_Controller::class, 'reset'])
        ->name('password.update');
});

// Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('modul_auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard')->with('success', 'Email verified!');
    })->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

Route::middleware(['auth', 'auth.user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [Profile_Controller::class, 'show'])->name('profile.show');
    Route::put('/profile/update', [Profile_Controller::class, 'update'])->name('profile.update');
    Route::put('/profile/update-password', [Profile_Controller::class, 'updatePassword'])->name('profile.update-password');
    Route::delete('/profile/delete', [Profile_Controller::class, 'delete'])->name('profile.delete');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Chat module routes
Route::middleware(['auth', 'auth.user'])->group(function () {
    Route::get('/chat', [Chat_Controller::class, 'index'])->name('chat.index');
    Route::get('/chat/{conversation}', [Chat_Controller::class, 'show'])->name('chat.show');
    Route::post('/chat/direct', [Chat_Controller::class, 'createDirectMessage'])->name('chat.create-direct');
    Route::post('/chat/group', [Chat_Controller::class, 'createGroupConversation'])->name('chat.create-group');
    Route::post('/chat/{conversation}/message', [Chat_Controller::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/{conversation}/participants', [Chat_Controller::class, 'addParticipants'])->name('chat.add-participants');
    Route::delete('/chat/{conversation}/leave', [Chat_Controller::class, 'leaveConversation'])->name('chat.leave');
    Route::post('/chat/{conversation}/mute', [Chat_Controller::class, 'toggleMute'])->name('chat.toggle-mute');
    Route::get('/chat/unread/count', [Chat_Controller::class, 'getUnreadCount'])->name('chat.unread-count');
    Route::post('/chat/offline', [Chat_Controller::class, 'setOffline'])->name('chat.set-offline');
    Route::get('/chat/users/online', [Chat_Controller::class, 'getOnlineUsers'])->name('chat.online-users');
    Route::put('/chat/{conversation}/update', [Chat_Controller::class, 'updateGroupConversation'])->name('chat.update-group');
    Route::post('/chat/{conversation}/upload', [Chat_Controller::class, 'uploadFile'])->name('chat.upload-file');
    Route::post('/chat/{conversation}/mark-read', [Chat_Controller::class, 'markAsRead'])->name('chat.mark-read');
    Route::post('/chat/conversation', [Chat_Controller::class, 'getOrCreateConversation'])->name('chat.get-conversation');
    Route::get('/chat/{conversation}/participants', [Chat_Controller::class, 'getParticipants'])->name('chat.get-participants');
    Route::delete('/chat/{conversation}/participants/{participant}', [Chat_Controller::class, 'removeParticipant'])->name('chat.remove-participant');
    Route::get('/chat/{conversation}/messages', [Chat_Controller::class, 'getMessages'])->name('chat.get-messages');
    Route::post('/chat/status', [Chat_Controller::class, 'updateStatus'])->name('chat.update-status');
    Route::get('/chat/users', [Chat_Controller::class, 'getUsers'])->name('chat.users');
    Route::get('/chat/{conversation}/participants/available', [Chat_Controller::class, 'getAvailableParticipants'])
        ->name('chat.available-participants');
});

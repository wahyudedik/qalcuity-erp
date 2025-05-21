<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Modul\Auth\UserController;
use App\Http\Controllers\Modul\Umum\ChatController;
use App\Http\Controllers\Modul\Auth\LoginController;
use App\Http\Controllers\Modul\Umum\CameraController;
use App\Http\Controllers\Modul\Auth\ProfileController;
use App\Http\Controllers\Modul\Branch\BranchController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Modul\Umum\NotificationController;
use App\Http\Controllers\Modul\Auth\ResetPasswordController;
use App\Http\Controllers\Modul\Auth\ForgotPasswordController;


Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Forgot Password Routes
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    // Reset Password Routes
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
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
    Route::prefix('profile')
        ->name('profile.')
        ->middleware(['auth'])
        ->group(function () {
            Route::get('/', [ProfileController::class, 'show'])->name('show');
            Route::put('/update', [ProfileController::class, 'update'])->name('update');
            Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
            Route::delete('/delete', [ProfileController::class, 'delete'])->name('delete');
        });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Chat module routes
Route::middleware(['auth', 'auth.user'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{conversation}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/direct', [ChatController::class, 'createDirectMessage'])->name('chat.create-direct');
    Route::post('/chat/group', [ChatController::class, 'createGroupConversation'])->name('chat.create-group');
    Route::post('/chat/{conversation}/message', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/{conversation}/participants', [ChatController::class, 'addParticipants'])->name('chat.add-participants');
    Route::delete('/chat/{conversation}/leave', [ChatController::class, 'leaveConversation'])->name('chat.leave');
    Route::post('/chat/{conversation}/mute', [ChatController::class, 'toggleMute'])->name('chat.toggle-mute');
    Route::get('/chat/unread/count', [ChatController::class, 'getUnreadCount'])->name('chat.unread-count');
    Route::post('/chat/offline', [ChatController::class, 'setOffline'])->name('chat.set-offline');
    Route::get('/chat/users/online', [ChatController::class, 'getOnlineUsers'])->name('chat.online-users');
    Route::put('/chat/{conversation}/update', [ChatController::class, 'updateGroupConversation'])->name('chat.update-group');
    Route::post('/chat/{conversation}/upload', [ChatController::class, 'uploadFile'])->name('chat.upload-file');
    Route::post('/chat/{conversation}/mark-read', [ChatController::class, 'markAsRead'])->name('chat.mark-read');
    Route::post('/chat/conversation', [ChatController::class, 'getOrCreateConversation'])->name('chat.get-conversation');
    Route::get('/chat/{conversation}/participants', [ChatController::class, 'getParticipants'])->name('chat.get-participants');
    Route::delete('/chat/{conversation}/participants/{participant}', [ChatController::class, 'removeParticipant'])->name('chat.remove-participant');
    Route::get('/chat/{conversation}/messages', [ChatController::class, 'getMessages'])->name('chat.get-messages');
    Route::post('/chat/status', [ChatController::class, 'updateStatus'])->name('chat.update-status');
    Route::get('/chat/users', [ChatController::class, 'getUsers'])->name('chat.users');
    Route::get('/chat/{conversation}/participants/available', [ChatController::class, 'getAvailableParticipants'])
        ->name('chat.available-participants');
});

// CCTV monitoring routes
Route::middleware(['auth', 'auth.user'])->group(function () {
    Route::resource('cameras', CameraController::class);
    Route::get('cameras/{camera}/check-connection', [CameraController::class, 'checkConnection'])
        ->name('cameras.check-connection');
    Route::get('cameras-check-all-connections', [CameraController::class, 'checkAllConnections'])
        ->name('cameras.check-all-connections');
});

// Route untuk mengelola user
Route::middleware(['auth', 'auth.user'])->group(function () {
    Route::resource('users', UserController::class);
});

// Route untuk mengelola branch
Route::middleware(['auth', 'auth.user'])->group(function () {
    // Branch module routes
    Route::resource('branches', BranchController::class);
    Route::get('/branches/{branch}/assign', [BranchController::class, 'showAssignmentForm'])->name('branches.assign');
    Route::post('/branches/{branch}/assign', [BranchController::class, 'assignUsers'])->name('branches.assign.users');
    Route::get('/branch-reports', [BranchController::class, 'reports'])->name('branches.reports');
    Route::get('/branches/switch/{branch}', [BranchController::class, 'switchBranch'])->name('branches.switch');
    Route::delete('/branches/{branch}/users', [BranchController::class, 'removeUsers'])->name('branches.users.remove');
    Route::get('/branch-reports/export-pdf', [BranchController::class, 'exportPdf'])->name('branches.reports.export-pdf');
    Route::get('/branch-reports/export-excel', [BranchController::class, 'exportExcel'])->name('branches.reports.export-excel');
});

// Route untuk notifikasi
Route::middleware(['auth'])->prefix('notifications')->group(function () {
    Route::post('/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::get('/download/{id}', [NotificationController::class, 'downloadFile'])->name('notifications.download');
    Route::get('/json', [NotificationController::class, 'getNotificationsJson'])->name('notifications.json');
});

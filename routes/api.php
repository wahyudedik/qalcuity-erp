<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Modul_Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [LoginController::class, 'loginApi']);

// Secured Routes for dev users
Route::middleware(['auth:sanctum', 'auth.dev'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('/dashboard-data', function () {
        return response()->json([
            'projects' => [
                'count' => 12,
                'recent' => [
                    ['id' => 1, 'name' => 'Project A', 'status' => 'In Progress'],
                    ['id' => 2, 'name' => 'Project B', 'status' => 'Completed'],
                ]
            ],
            'production' => [
                'today' => 98.5,
                'week' => 687.2,
                'month' => 2945.8
            ],
            'materials' => [
                'cement' => 82,
                'sand' => 75,
                'aggregate' => 90
            ],
            'orders' => [
                'pending' => 24,
                'completed' => 156,
                'cancelled' => 8
            ]
        ]);
    });
});

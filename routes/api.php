<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\AdminContentController;
use App\Http\Controllers\Api\Public\PublicAppController;
use App\Http\Controllers\Api\Public\PublicContentController;
use App\Http\Controllers\Api\Super\SuperAppController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Super\UserController;


// ============ PUBLIC ============
Route::get('/apps', [PublicAppController::class, 'index']);
Route::get('/contents', [PublicContentController::class, 'index']);
Route::post('/public/contents', [PublicContentController::class, 'store']);
Route::get('/contents/{id}', [PublicContentController::class, 'show']);

// ============ AUTH ============
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // ============ ADMIN & SUPER ADMIN ============
    Route::middleware('role:admin,superadmin')->prefix('admin')->group(function () {
    Route::get('/contents/{id}', [AdminContentController::class, 'show']);
    
    Route::get('/contents', [AdminContentController::class, 'index']);
    Route::get('/contents/{id}', [AdminContentController::class, 'show']); 
    Route::patch('/contents/{id}/approve', [AdminContentController::class, 'approve']);
    Route::patch('/contents/{id}/reject', [AdminContentController::class, 'reject']);
    Route::put('/contents/{id}', [AdminContentController::class, 'update']);
    Route::delete('/contents/{id}', [AdminContentController::class, 'destroy']); 
});

    Route::middleware('auth:sanctum', 'role:admin,superadmin')->group(function () {
    Route::delete('/admin/contents/{id}', [AdminContentController::class, 'destroy']);
    });

    Route::middleware('role:superadmin')->prefix('super')->group(function () {

    Route::get('/apps', [SuperAppController::class, 'index']);
    Route::post('/apps', [SuperAppController::class, 'store']);
    Route::put('/apps/{id}', [SuperAppController::class, 'update']);
    Route::delete('/apps/{id}', [SuperAppController::class, 'destroy']);

    
    Route::apiResource('users', UserController::class);
    });

});

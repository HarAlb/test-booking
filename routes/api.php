<?php

use Illuminate\Support\Facades\Route;

use Interfaces\Http\Controllers\ResourceController;
use Interfaces\Http\Controllers\BookingController;
use Interfaces\Http\Controllers\AuthController;

Route::middleware(['api', 'throttle:100,1'])->group(function () {
    Route::get('/resources', [ResourceController::class, 'index']);
    Route::post('/resources', [ResourceController::class, 'store']);
    Route::get('/resources/{id}/bookings', [BookingController::class, 'getByResource']);

    Route::middleware('auth:api')->group(function () {
        Route::post('/bookings', [BookingController::class, 'store']);
        Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
    });

    Route::post('/auth/login', [AuthController::class, 'login']);

//    Route::post('/resources', [ResourceController::class, 'store']);
    // другие API маршруты
});

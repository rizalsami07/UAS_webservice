<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ReservationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// =====================
// AUTH (TANPA TOKEN)
// =====================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// =====================
// AUTH (PAKAI TOKEN)
// =====================
Route::middleware('auth:api')->group(function () {

    // auth
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    // =====================
    // SERVICE (CRUD)
    // =====================
    Route::apiResource('services', ServiceController::class);

    // =====================
    // RESERVATION (CRUD)
    // =====================
    Route::apiResource('reservations', ReservationController::class);
});

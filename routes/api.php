<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;


Route::post('login', AuthController::class);
Route::group(['middleware' => 'auth:sanctum'], function () {
    //роуты ресурсов
    Route::get('resources', [ResourceController::class, 'index']);
    Route::post('resources', [ResourceController::class, 'store']);
    Route::get('resources/{resource}/bookings', [ResourceController::class, 'resourceBookings']);

    Route::post('bookings', [BookingController::class, 'store']);
    Route::delete('bookings/{booking}', [BookingController::class, 'destroy']);
});

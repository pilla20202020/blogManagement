<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/blog/{id}', [BlogController::class, 'show']);
    Route::post('/blog', [BlogController::class, 'store']);
    Route::put('/blog/{id}', [BlogController::class, 'update']);
    Route::delete('/blog/{id}', [BlogController::class, 'destroy']);

    Route::middleware('admin')->group(function () {
        Route::apiResource('users', UserController::class);
    });
});


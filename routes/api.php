<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('/v1')->group(function () {
        Route::post('todos', [TodoController::class, 'store']);
        Route::get('todos', [TodoController::class, 'index']);
        Route::get('todos/{id}', [TodoController::class, 'show']);
        Route::put('todos/{id}', [TodoController::class, 'update']);
        Route::delete('todos/{id}', [TodoController::class, 'destroy']);
    });
});

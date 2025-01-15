<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('/v1')->group(function () {
        Route::get('todos', [TodoController::class, 'index']);
        Route::post('todos', [TodoController::class, 'storeTodo']);
        Route::get('todos/{id}', [TodoController::class, 'showTodo']);
        Route::put('todos/{id}', [TodoController::class, 'updateTodo']);
        Route::delete('todos/{id}', [TodoController::class, 'destroyTodo']);
    });
});

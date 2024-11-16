<?php

use App\Http\Controllers\SessionController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [TaskController::class, "index"]);
    Route::get('/tasks/create', [TaskController::class, 'create']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{task}', [TaskController::class, 'show']);
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);

    Route::get("/users/{user}/edit", [UserController::class, "edit"]);
    Route::put("/users/{user}", [UserController::class, "update"]);
    Route::delete("/users/{user}", [UserController::class, "destroy"]);
});

Route::get('/register', [UserController::class, "create"]);
Route::post('/register', [UserController::class, "store"]);

Route::get("/login", [SessionController::class, "create"])->name("login");
Route::post("/login", [SessionController::class, "store"]);
Route::delete("/logout", [SessionController::class, "destroy"]);

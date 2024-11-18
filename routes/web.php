<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;

Route::get("/admin", [AdminController::class, "index"])->can("viewAny", Task::class);

Route::controller(TaskController::class)->group(function () {
    Route::get('/', "index")->middleware("auth");
    Route::get('/tasks/create', 'create')->middleware("auth");
    Route::post('/tasks', 'store')->middleware("auth");
    Route::get('/tasks/{task}', 'show')->can("view", "task");
    Route::get('/tasks/{task}/edit', 'edit')->can("edit", "task");
    Route::put('/tasks/{task}', 'update')->can("update", "task");
    Route::delete('/tasks/{task}', 'destroy')->can("delete", "task");
});

Route::controller(UserController::class)->group(function () {
    Route::get('/register', "create")->middleware("guest");
    Route::post('/register', "store")->middleware("guest");
    Route::get("/users/{user}/edit", "edit")->can("edit", "user");
    Route::put("/users/{user}", "update")->can("update", "user");
    Route::delete("/users/{user}", "destroy")->can("delete", "user");
});

Route::controller(SessionController::class)->group(function () {
    Route::get("/login", "create")->middleware("guest")->name("login");
    Route::post("/login", "store")->middleware("guest");
    Route::delete("/logout", "destroy")->middleware("auth");
});
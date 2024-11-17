<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::controller(TaskController::class)->group(function () {
    Route::get('/', "index")->middleware("auth");
    Route::get('/tasks/create', 'create')->middleware("auth");
    Route::post('/tasks', 'store')->middleware("auth");
    Route::get('/tasks/{task}', 'show')->middleware("can:view,task");
    Route::get('/tasks/{task}/edit', 'edit')->middleware("can:edit,task");
    Route::put('/tasks/{task}', 'update')->middleware("can:update,task");
    Route::delete('/tasks/{task}', 'destroy')->middleware("can:delete,task");
});

Route::controller(UserController::class)->group(function () {
    Route::get('/register', "create")->middleware("guest");
    Route::post('/register', "store")->middleware("guest");
    Route::get("/users/{user}/edit", "edit")->middleware(["auth", "can:edit,user"]);
    Route::put("/users/{user}", "update")->middleware(["auth", "can:update,user"]);
    Route::delete("/users/{user}", "destroy")->middleware(["auth", "can:delete,user"]);
});

Route::controller(SessionController::class)->group(function () {
    Route::get("/login", "create")->middleware("guest")->name("login");
    Route::post("/login", "store")->middleware("guest");
    Route::delete("/logout", "destroy")->middleware("auth");
});
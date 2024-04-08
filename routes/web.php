<?php

use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/dashboard', [TasksController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/report-task', [TasksController::class, 'reportView']);
    Route::post('/report-task', [TasksController::class, 'reportValues']);
    Route::get('tasks/create',[TasksController::class,'create']);
    Route::post('tasks',[TasksController::class,'store']);
    Route::get('tasks',[TasksController::class,'index']);
    Route::post('tasks/search',[TasksController::class,'search']);
    Route::delete('tasks/{id}',[TasksController::class,'destroy']);
    Route::put('tasks/{id}',[TasksController::class,'update']);
    Route::get('tasks/{id}/edit',[TasksController::class,'edit']);
    Route::get('users',[\App\Http\Controllers\UserController::class ,'index' ]);
    Route::get('users/create',[\App\Http\Controllers\UserController::class ,'create' ]);
    Route::post('users',[\App\Http\Controllers\UserController::class ,'store' ]);
    Route::delete('user/{id}',[UserController::class,'destroy']);


});

require __DIR__.'/auth.php';

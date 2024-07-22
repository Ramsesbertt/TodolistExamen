<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [TaskController::class, 'index'])->name('home');
    Route::resource('tasks', TaskController::class)->except(['show']);
    Route::get('/tasks/search', [TaskController::class, 'search'])->name('tasks.search');
});


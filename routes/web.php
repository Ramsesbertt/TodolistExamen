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
    Route::post('/tasks/{task}/updateStatus', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
    Route::get('/tasks/calendar', [TaskController::class, 'calendar'])->name('tasks.calendar');
    Route::get('/settings', [TaskController::class, 'settings'])->name('tasks.settings');
    Route::get('/kanban', [TaskController::class, 'kanban'])->name('tasks.kanban');
    Route::get('/about', [TaskController::class, 'about'])->name('tasks.about');
});



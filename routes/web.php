<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
 
// Public route
Route::get('/', \App\Http\Controllers\WelcomeController::class)->name('welcome');

//Authenticated routes
require __DIR__.'/auth.php';
Route::name('user.')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('user/events', App\Http\Controllers\User\EventController::class);
    Route::get('user/events/{id}/tasks', [App\Http\Controllers\User\TaskController::class,'create'])->name('events.tasks.create');
    Route::post('user/events/{id}/tasks', [App\Http\Controllers\User\TaskController::class,'store'])->name('events.tasks.store');
});
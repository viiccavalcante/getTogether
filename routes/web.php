<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public visible routes
//faezr uma pagina simples 

//Authenticated routes
require __DIR__.'/auth.php';
Route::name('user.')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('user/events', App\Http\Controllers\User\EventController::class);
});

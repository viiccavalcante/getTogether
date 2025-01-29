<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::name('api.')->group( function() {
    Route::get('events', [\App\Http\Controllers\Api\EventController::class, 'index'] )->name('events.index');
    Route::get('events/{id}', [\App\Http\Controllers\Api\EventController::class, 'show'] )->name('events.show');
    
    Route::get('creators', [\App\Http\Controllers\Api\CreatorController::class, 'index'] )->name('creator.index');
    Route::get('creators/{id}', [\App\Http\Controllers\Api\CreatorController::class, 'show'] )->name('creator.show');
});

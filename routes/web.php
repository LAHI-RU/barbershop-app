<?php

use App\Http\Controllers\BarberController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::resource('barbers', BarberController::class);
    });
});

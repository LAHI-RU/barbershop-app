<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Customer Appointment Routes
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('barbers', BarberController::class);
        Route::resource('services', ServiceController::class);

        // Admin Appointment Management
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('admin.appointments.index');
        Route::patch('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('admin.appointments.status');
    });
});

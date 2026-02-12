<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ReservationController;
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
});
// Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
//     Route::get('/admin/dashboard', [adminController::class, 'index'])->name('admin.dashboard');
// });


Route::middleware(['auth', 'role:admin'])
    ->get('/admin/dashboard', [DashboardController::class, 'index']);
    
Route::middleware(['auth', 'role:admin'])
    ->get('/admin/restaurants/{id}/reservations', [ReservationController::class, 'reservationbyrestaurant']);


Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:client'])->group(function () {
        Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
        Route::post('/reservations', [ReservationController::class, 'store_reservation'])->name('reservations.store');
    });

    Route::middleware(['role:client|restaurant_owner'])->group(function () {
        Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
        Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    });
});
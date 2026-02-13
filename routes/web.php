<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\RestaurantController;
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





Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

route::get('/restaurants/create',[RestaurantController::class,'create'])->name('restaurant.create');
route::post('/restaurant/store',[RestaurantController::class,'store'])->name('restaurant.store');
route::get('restaurant/{id}/edit',[RestaurantController::class,'edit'])->name('restaurant.edit');
route::put('restaurant/{id}/update',[RestaurantController::class,'update'])->name('restaurant.update');

route::get('/restaurants',[RestaurantController::class,'index'])->name('restaurant.index');
route::get('/restaurant/{id}',[RestaurantController::class,'deatils'])->name('restaurant.details');
Route::get('/restaurants/search', [RestaurantController::class, 'search'])->name('restaurant.search');

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
        Route::delete('/reservations/{reservation}', [ReservationController::class, 'delete'])->name('reservations.delete');
    });
});


Route::get('paypal', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::post('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
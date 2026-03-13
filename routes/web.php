<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\CustomerController; // <-- Added Customer Controller
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes Configuration
|--------------------------------------------------------------------------
*/

// 1. Public Landing Page
Route::get('/', function () {
    return view('welcome');
});

/**
 * 2. Main Dashboard
 * Redirection logic is handled inside VehicleController@index
 */
Route::get('/dashboard', [VehicleController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/**
 * 3. Protected Routes (User must be logged in)
 */
Route::middleware('auth')->group(function () {
    
    /**
     * CUSTOMER ROUTES (Role 1)
     */
    Route::resource('vehicles', VehicleController::class);
    Route::resource('bookings', BookingController::class);
    Route::get('/history', [BookingController::class, 'index'])->name('bookings.index');

    /**
     * Profile Management
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * 4. ADMIN ROUTES (Role 2)
     */
    Route::prefix('admin')->name('admin.')->group(function () {
        // Manage Customer Bookings
        Route::get('/bookings', [AdminController::class, 'index'])->name('bookings');
        Route::patch('/bookings/{id}', [AdminController::class, 'update'])->name('update');

        // Manage Service Catalog
        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

        // Manage Customers (NEW ROUTES)
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::patch('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    });

    /**
     * 5. MECHANIC ROUTES (Role 3)
     */
    Route::prefix('mechanic')->name('mechanic.')->group(function () {
        Route::get('/dashboard', [MechanicController::class, 'index'])->name('dashboard');
        Route::patch('/update-job/{id}', [MechanicController::class, 'updateStatus'])->name('update');
        Route::get('/history', [MechanicController::class, 'history'])->name('history');
    });
});

/**
 * Authentication Logic
 */
require __DIR__.'/auth.php';
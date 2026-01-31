<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController; // <--- NEW: Added BookingController
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; // Add this to top!
use App\Http\Controllers\ServiceController; // Add to top!
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- AUTHENTICATED ROUTES ---
Route::middleware('auth')->group(function () {
    
    // Feature 1: Vehicle Management
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');

    // Feature 2: Booking System
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- FEATURE 3: SERVICE HISTORY (NEW) ---
    Route::get('/history', [BookingController::class, 'index'])->name('bookings.index');

    // --- ADMIN PANEL ROUTES ---
    // Note: In a real app, we would use 'middleware' => 'admin' here.
    Route::get('/admin/bookings', [AdminController::class, 'index'])->name('admin.bookings');
    Route::patch('/admin/bookings/{id}', [AdminController::class, 'update'])->name('admin.update');

    // --- FEATURE 5: SERVICE MANAGEMENT ---
    Route::get('/admin/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/admin/services', [ServiceController::class, 'store'])->name('services.store');
    Route::delete('/admin/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
});

// Load Auth Routes
require __DIR__.'/auth.php';

// --- STEP E: TEMPORARY SETUP ROUTE ---
// Visit http://127.0.0.1:8000/setup-services ONCE to populate your database.
Route::get('/setup-services', function() {
    
    // clear existing to prevent duplicates if you refresh
    \App\Models\Service::truncate(); 

    // Add Service 1
    \App\Models\Service::create([
        'service_name' => 'Basic Maintenance',
        'description' => 'Oil change and basic checkup',
        'price' => 150.00,
        'duration_minutes' => 60
    ]);

    // Add Service 2
    \App\Models\Service::create([
        'service_name' => 'Full Inspection',
        'description' => 'Comprehensive vehicle check',
        'price' => 300.00,
        'duration_minutes' => 120
    ]);

    // Add Service 3
    \App\Models\Service::create([
        'service_name' => 'Tire Rotation',
        'description' => 'Rotate and balance tires',
        'price' => 80.00,
        'duration_minutes' => 45
    ]);

    return 'Services added successfully! You can now go to /bookings/create';
});
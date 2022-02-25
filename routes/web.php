<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ManufacturerController;

// Auth Routes
require __DIR__ . '/auth.php';

// Default route will be redirected to login screen for unauthenticated users
Route::redirect('/', '/dashboard');



Route::middleware('auth')->group(function () {

    // Default route
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    // Profile management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile');
        Route::get('profile/edit', 'create')->name('profile.edit');
        Route::put('profile/update', 'update')->name('profile.update');
    });


    // Resources
    Route::resource('stocks', StockController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('medicines', MedicineController::class);
    Route::resource('purchases', PurchaseController::class);
    Route::resource('manufacturers', ManufacturerController::class);
});


// Images
Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');

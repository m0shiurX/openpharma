<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ManufacturerController;

// Auth Routes
require __DIR__ . '/auth.php';

// Default route will be redirected to login screen for unauthencated users
Route::redirect('/', '/dashboard');

// Authenticated routes will go here
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('profile', [ProfileController::class, 'index'])
    ->name('profile')
    ->middleware('auth');

Route::get('profile/edit', [ProfileController::class, 'create'])
    ->name('profile.edit')
    ->middleware('auth');

Route::put('profile/update', [ProfileController::class, 'update'])
    ->name('profile.update')
    ->middleware('auth');




// Images
Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');



// Manufacturers
Route::get('manufacturers', [ManufacturerController::class, 'index'])
    ->name('manufacturers.index')
    ->middleware('auth');

// Manufacturers
Route::get('manufacturers/create', [ManufacturerController::class, 'create'])
    ->name('manufacturers.create')
    ->middleware('auth');
Route::post('manufacturers/store', [ManufacturerController::class, 'store'])
    ->name('manufacturers.store')
    ->middleware('auth');

Route::get('manufacturers/{manufacturer}', [ManufacturerController::class, 'show'])
    ->name('manufacturers.show')
    ->middleware('auth');

Route::get('manufacturers/{manufacturer}/edit', [ManufacturerController::class, 'edit'])
    ->name('manufacturers.edit')
    ->middleware('auth');

Route::put('manufacturers/{manufacturer}', [ManufacturerController::class, 'update'])
    ->name('manufacturers.update')
    ->middleware('auth');

Route::delete('manufacturers/{manufacturer}', [ManufacturerController::class, 'destroy'])
    ->name('manufacturers.destroy')
    ->middleware('auth');

Route::resource('customers', CustomerController::class);
Route::resource('medicines', MedicineController::class);

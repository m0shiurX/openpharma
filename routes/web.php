<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\Auth\ProfileController;

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

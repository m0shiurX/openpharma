<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Auth Routes
require __DIR__ . '/auth.php';

// Default route will be redirected to login screen for unauthencated users
Route::redirect('/', '/dashboard');

// Authenticated routes will go here
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

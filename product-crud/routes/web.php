<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Original Laravel Breeze profile routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Product routes
    Route::resource('products', ProductController::class);
    
    // Custom profile routes
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');
    
    Route::get('/profile/settings', function () {
        return view('profile.settings');
    })->name('profile.settings');
});

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Home page with featured products
Route::get('/', [ProductController::class, 'index'])->name('home');

// Product routes
Route::resource('products', ProductController::class);

// Category routes
Route::resource('categories', CategoryController::class);

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Order routes
Route::resource('orders', OrderController::class);
Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

// Authentication routes (Laravel Breeze/Fortify will handle these)
require __DIR__.'/auth.php';

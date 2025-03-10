<?php

use App\Http\Controllers\SimpleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greet', [SimpleController::class, 'greet']);

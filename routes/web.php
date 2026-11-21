<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')
        ->name('dashboard');

    Route::resource('products', ProductController::class)
        ->except(['show']);

    Route::resource('customers', CustomerController::class)
        ->except(['show']);

    Route::resource('staff', UserController::class)
        ->parameters(['staff' => 'user'])
        ->except(['show']);

    Route::resource('sales', SaleController::class)
        ->only(['index', 'create', 'store']);
});

require __DIR__.'/auth.php';
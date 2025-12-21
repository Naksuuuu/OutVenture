<?php

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductsVariantSpecContoller;
use App\Http\Controllers\Admin\ProductsVariantSpecController;
use App\Http\Controllers\Admin\ProductVarianController;


Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::get('products', function () {
    return view('public.products.index');
});

Route::get('testing', function () {
    return view('public.products.show');
});

Route::get('user', function () {
    return view('user.profile');
});

Route::name('auth.')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('/login', 'showLoginForm')->name('show.login');
            Route::post('/login', 'login')->name('login');
        });

        Route::post('/logout', 'logout')->middleware('auth')->name('logout');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('/register', 'showRegistrationForm')->name('show.register');
            Route::post('/register', 'register')->name('register');
        });
    });
});

Route::middleware('auth')->prefix('dashboard')->name('admin.')->group(function () {
    Route::get('/', [Dashboard::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::get('products/sizes/{category}', [ProductController::class, 'getSizesByCategory'])->name('products.sizes');

    // Product Variant Routes -> use ProductVarianController
    Route::post('products/{product}/variants', [ProductVarianController::class, 'store'])->name('products.variants.store');
    Route::put('products/{product}/variants/{variant}', [ProductVarianController::class, 'update'])->name('products.variants.update');
    Route::delete('products/{product}/variants/{variant}', [ProductVarianController::class, 'destroy'])->name('products.variants.destroy');

    // Product Variant Specification Routes
    Route::post('products/{product}/variants/{variant}/specs', [ProductsVariantSpecController::class, 'store'])->name('products.variants.specs.store');
    Route::put('products/{product}/variants/{variant}/specs/{spec}', [ProductsVariantSpecController::class, 'update'])->name('products.variants.specs.update');
    Route::delete('products/{product}/variants/{variant}/specs/{spec}', [ProductsVariantSpecController::class, 'destroy'])->name('products.variants.specs.destroy');

    // Category Management Routes
    Route::resource('categories', CategoryController::class);
});

// Google OAuth Routes
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::get('auth/google/logout', [GoogleController::class, 'logout'])->name('google.logout');

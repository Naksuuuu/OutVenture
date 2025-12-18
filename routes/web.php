<?php

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.home');
})->name('home');



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
    Route::resource('products', ProductsController::class);
});

// Google OAuth Routes
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::get('auth/google/logout', [GoogleController::class, 'logout'])->name('google.logout');

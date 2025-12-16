<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

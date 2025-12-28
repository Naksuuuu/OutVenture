<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Livewire\Admin\Product\Index as DashboardProductIndex;
use App\Livewire\Admin\Product\Edit as DashboardProductEdit;
use App\Livewire\Admin\Product\Create as DashboardProductCreate;
use App\Livewire\Admin\Product\Show as DashboardProductShow;


use App\Livewire\Admin\Category\Index as DashboardCategoryIndex;
use App\Livewire\Admin\Category\Create as DashboardCategoryCreate;
use App\Livewire\Admin\Category\Edit as DashboardCategoryEdit;
use App\Livewire\Admin\Category\Show as DashboardCategoryShow;

use App\Livewire\Admin\Brand\Index as DashboardBrandIndex;
use App\Livewire\Admin\Brand\Create as DashboardBrandCreate;
use App\Livewire\Admin\Brand\Edit as DashboardBrandEdit;
use App\Livewire\Admin\Brand\Show as DashboardBrandShow;

use App\Livewire\Admin\Size\Index as DashboardSizeIndex;
use App\Livewire\Admin\Size\Create as DashboardSizeCreate;
use App\Livewire\Admin\Size\Edit as DashboardSizeEdit;
use App\Livewire\Admin\Size\Show as DashboardSizeShow;

use App\Livewire\Admin\Order\Index as DashboardOrderIndex;
use App\Livewire\Admin\Order\Show as DashboardOrderShow;

use App\Livewire\Admin\Color\Index as DashboardColorIndex;
use App\Livewire\Admin\Color\Edit as DashboardColorEdit;
use App\Livewire\Admin\Color\Create as DashboardColorCreate;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Public\Product\Index as PublicProductIndex;
use App\Livewire\Public\Product\Show as PublicProductShow;

use App\Livewire\Public\Brand\Index as PublicBrandIndex;
use App\Livewire\Public\Brand\Show as PublicBrandShow;
use App\Models\User;
use Illuminate\Auth\Events\Verified;

// Public Routes - Livewire
Route::get('/', App\Livewire\Public\Home::class)->name('home');
Route::get('products', PublicProductIndex::class)->name('products.index');
Route::get('products/{id}', PublicProductShow::class)->name('products.show');

Route::get('brands', PublicBrandIndex::class)->name('brands.index');
Route::get('brands/{id}', PublicBrandShow::class)->name('brands.show');

// User Profile
Route::middleware('auth')->group(function () {
    Route::get('user/profile', App\Livewire\User\Profile::class)->name('user.profile');
    Route::get('user/orders', App\Livewire\User\Order\Index::class)->name('user.orders.index');
    Route::get('user/orders/{id}/show', App\Livewire\User\Order\Show::class)->name('user.orders.show');
    Route::get('user/carts', App\Livewire\User\Cart\Index::class)->name('user.carts.index');
    Route::get('user/change-password', App\Livewire\Auth\ChangePassword::class)->name('user.change-password');
});

// Auth Routes - Livewire
Route::name('auth.')->middleware('guest')->group(function () {
    Route::get('/login', App\Livewire\Auth\Login::class)->name('login');
    Route::get('/register', App\Livewire\Auth\Register::class)->name('register');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('auth.login');
})->middleware('auth')->name('auth.logout');

// Admin Routes - Livewire
Route::middleware(['auth', 'admin'])->prefix('dashboard')->name('admin.')->group(function () {
    Route::get('/', App\Livewire\Admin\Dashboard::class)->name('dashboard');

    // Products Management
    Route::get('products', DashboardProductIndex::class)->name('products.index');
    Route::get('products/create', DashboardProductCreate::class)->name('products.create');
    Route::get('products/{productId}/edit', DashboardProductEdit::class)->name('products.edit');
    Route::get('products/{productId}/show', DashboardProductShow::class)->name('products.show');

    // Categories Management
    Route::get('categories', DashboardCategoryIndex::class)->name('categories.index');
    Route::get('categories/create', DashboardCategoryCreate::class)->name('categories.create');
    Route::get('categories/{categoryId}/edit', DashboardCategoryEdit::class)->name('categories.edit');
    Route::get('categories/{categoryId}/show', DashboardCategoryShow::class)->name('categories.show');

    // Brands Management
    Route::get('brands', DashboardBrandIndex::class)->name('brands.index');
    Route::get('brands/create', DashboardBrandCreate::class)->name('brands.create');
    Route::get('brands/{brandId}/edit', DashboardBrandEdit::class)->name('brands.edit');
    Route::get('brands/{brandId}/show', DashboardBrandShow::class)->name('brands.show');

    // Size Management
    Route::get('sizes', DashboardSizeIndex::class)->name('sizes.index');
    Route::get('sizes/create', DashboardSizeCreate::class)->name('sizes.create');
    Route::get('sizes/{sizeGroupId}/edit', DashboardSizeEdit::class)->name('sizes.edit');
    Route::get('sizes/{sizeGroupId}/show', DashboardSizeShow::class)->name('sizes.show');

    // Orders Management
    Route::get('orders', DashboardOrderIndex::class)->name('orders.index');
    Route::get('orders/{id}/show', DashboardOrderShow::class)->name('orders.show');

    // Colors Management
    Route::get('colors', DashboardColorIndex::class)->name('colors.index');
    Route::get('colors/create', DashboardColorCreate::class)->name('colors.create');
    Route::get('colors/{colorId}/edit', DashboardColorEdit::class)->name('colors.edit');

    // Admin User Management (Only SuperAdmin)
    Route::middleware('superadmin')->group(function () {
        Route::get('users', App\Livewire\Admin\User\Index::class)->name('users.index');
        Route::get('users/{id}/show', App\Livewire\Admin\User\Show::class)->name('users.show');
        Route::get('users/{id}/edit', App\Livewire\Admin\User\Edit::class)->name('users.edit');
    });
});


// Lupa Password Routes - Livewire
Route::get('/forgot-password', ForgotPassword::class)->middleware('guest')->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)->middleware('guest')->name('password.reset');



// Google OAuth Routes
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::get('auth/google/logout', [GoogleController::class, 'logout'])->name('google.logout');

// Email Verification Routes
Route::get('/email/verify/{id}/{hash}', function (Request $request) {
    $user = User::findOrFail($request->route('id'));
    if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
        return redirect()->route('auth.login')->with('error', 'Link verifikasi tidak valid.');
    }
    if ($user->hasVerifiedEmail()) {
        return redirect()->route('auth.login')->with('success', 'Email sudah terverifikasi, silakan login.');
    }
    if ($user->markEmailAsVerified()) {
        event(new Verified($user));
    }
    return redirect()->route('auth.login')->with('success', 'Email berhasil diverifikasi! Silakan login.');
})->name('verification.verify');

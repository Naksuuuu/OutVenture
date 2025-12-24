<?php

use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Livewire\Admin\Product\Index as DashboardProductIndex;
use App\Livewire\Admin\Product\Edit as DashboardProductEdit;
use App\Livewire\Admin\Product\Create as DashboardProductCreate;


use App\Livewire\Admin\Category\Index as DashboardCategoryIndex;
use App\Livewire\Admin\Category\Create as DashboardCategoryCreate;
use App\Livewire\Admin\Category\Edit as DashboardCategoryEdit;
use App\Livewire\Admin\Category\Show as DashboardCategoryShow;

use App\Livewire\Admin\Brand\Index as DashboardBrandIndex;
use App\Livewire\Admin\Size\Index as DashboardSizeIndex;


use App\Livewire\Public\Product\Index as PublicProductIndex;
use App\Livewire\Public\Brand\Index as PublicBrandIndex;
use App\Livewire\Public\Product\Show as PublicProductShow;


// Public Routes - Livewire
Route::get('/', App\Livewire\Public\Home::class)->name('home');
Route::get('products', PublicProductIndex::class)->name('products.index');
Route::get('products/{id}', PublicProductShow::class)->name('products.show');

Route::get('brands', PublicBrandIndex::class)->name('brands.index');

// User Profile
Route::middleware('auth')->group(function () {
    Route::get('user/profile', App\Livewire\User\Profile::class)->name('user.profile');
    Route::get('user/orders', App\Livewire\User\Order\Index::class)->name('user.orders.index');
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

    // Categories Management
    Route::get('categories', DashboardCategoryIndex::class)->name('categories.index');
    Route::get('categories/create', DashboardCategoryCreate::class)->name('categories.create');
    Route::get('categories/{categoryId}/edit', DashboardCategoryEdit::class)->name('categories.edit');
    Route::get('categories/{categoryId}/show', DashboardCategoryShow::class)->name('categories.show');

    // Brands Management
    Route::get('brands', DashboardBrandIndex::class)->name('brands.index');

    // Size Management
    Route::get('sizes', DashboardSizeIndex::class)->name('sizes.index');
});

// Google OAuth Routes
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::get('auth/google/logout', [GoogleController::class, 'logout'])->name('google.logout');

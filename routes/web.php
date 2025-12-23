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


use App\Livewire\Public\Product\Index as PublicProductIndex;
use App\Livewire\Public\Product\Show as PublicProductShow;

// Public Routes - Livewire
Route::get('/', App\Livewire\Public\Home::class)->name('home');
Route::get('products', PublicProductIndex::class)->name('products.index');
Route::get('products/{id}', PublicProductShow::class)->name('products.show');

// User Profile
Route::middleware('auth')->group(function () {
    Route::get('user/profile', App\Livewire\User\Profile::class)->name('user.profile');
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
Route::middleware('auth')->prefix('dashboard')->name('admin.')->group(function () {
    Route::get('/', App\Livewire\Admin\Dashboard::class)->name('dashboard');

    // Products Management
    Route::get('products', DashboardProductIndex::class)->name('products.index');
    Route::get('products/create', DashboardProductCreate::class)->name('products.create');
    Route::get('products/{productId}/edit', DashboardProductEdit::class)->name('products.edit');

    // Product Variant Routes - Keep controllers for API-like operations
    // Route::post('products/{product}/variants', [ProductVarianController::class, 'store'])->name('products.variants.store');
    // Route::put('products/{product}/variants/{variant}', [ProductVarianController::class, 'update'])->name('products.variants.update');
    // Route::delete('products/{product}/variants/{variant}', [ProductVarianController::class, 'destroy'])->name('products.variants.destroy');

    // Product Variant Specification Routes
    // Route::post('products/{product}/variants/{variant}/specs', [ProductsVariantSpecController::class, 'store'])->name('products.variants.specs.store');
    // Route::put('products/{product}/variants/{variant}/specs/{spec}', [ProductsVariantSpecController::class, 'update'])->name('products.variants.specs.update');
    // Route::delete('products/{product}/variants/{variant}/specs/{spec}', [ProductsVariantSpecController::class, 'destroy'])->name('products.variants.specs.destroy');

    // Categories Management
    Route::get('categories', DashboardCategoryIndex::class)->name('categories.index');
    Route::get('categories/create', DashboardCategoryCreate::class)->name('categories.create');
    Route::get('categories/{categoryId}/edit', DashboardCategoryEdit::class)->name('categories.edit');
});

// Google OAuth Routes
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::get('auth/google/logout', [GoogleController::class, 'logout'])->name('google.logout');

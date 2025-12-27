<?php

use App\Http\Controllers\MidtransCallbackController;
use Illuminate\Support\Facades\Route;

// Midtrans Payment Callback - tidak pakai CSRF protection
Route::post('/payment/callback', [MidtransCallbackController::class, 'callback']);

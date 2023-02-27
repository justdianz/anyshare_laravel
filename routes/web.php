<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\UserRecoveryController;
use App\Http\Controllers\UserSigninController;
use App\Http\Controllers\UserSignupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// User registration & recovery
Route::middleware(['guest'])->group(function () {
    Route::controller(UserSignupController::class)->group(function () {
        Route::get('/signup', 'show')->name('signupPage');
        Route::post('/signup', 'store')->name('signupHandler');
        // more socialite
    });

    Route::controller(UserRecoveryController::class)->group(function () {
        Route::get('/forgot-password', 'show')->name('password.request');
        Route::post('/forgot-password', 'sendRequest')->name('password.email');
        Route::get('/reset-password/{token}', 'passwordForm')->name('password.reset');
        Route::post('/reset-password', 'passwordUpdate')->name('password.update');
    });
});
// Authentication route
Route::controller(UserSigninController::class)->group(function () {
    Route::get('/signin', 'show')->middleware('guest')->name('login');
    Route::post('/signin', 'auth')->middleware('guest')->name('loginHandler');
    // more socialite
    // logout
    Route::post('/signout', 'logout')->middleware('auth')->name('logout');
});

// Email verification
Route::controller(EmailVerificationController::class)->group(function () {
    Route::get('/email/verify', 'notice')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verifyMe')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'resend')->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

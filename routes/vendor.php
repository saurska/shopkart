<?php

use App\Http\Controllers\VendorAuth\AuthenticatedSessionController;
use App\Http\Controllers\VendorAuth\ConfirmablePasswordController;
use App\Http\Controllers\VendorAuth\EmailVerificationNotificationController;
use App\Http\Controllers\VendorAuth\EmailVerificationPromptController;
use App\Http\Controllers\VendorAuth\NewPasswordController;
use App\Http\Controllers\VendorAuth\PasswordController;
use App\Http\Controllers\VendorAuth\PasswordResetLinkController;
use App\Http\Controllers\VendorAuth\RegisteredVendorController;
use App\Http\Controllers\VendorAuth\VerifyEmailController;
use App\Http\Controllers\Profile\AvatarController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredVendorController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredVendorController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');

    // Google login 
    Route::get('login/google', [AuthenticatedSessionController::class, 'redirectToGoogle']);
    Route::get('login/google/callback', [AuthenticatedSessionController::class, 'handleGoogleCallback']);

});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('avatar/update', [AvatarController::class, 'update'])->name('avatar.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

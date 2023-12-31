<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController\RegistrationController;
use App\Http\Controllers\VendorController\PasswordController;
use App\Http\Controllers\VendorController\NewPasswordController;
use App\Http\Controllers\VendorController\PasswordResetLinkController;
use App\Http\Controllers\VendorController\EmailVerificationNotificationController;
use App\Http\Controllers\VendorController\EmailVerificationPromptController;
use App\Http\Controllers\VendorController\VerifyEmailController;
use App\Http\Controllers\VendorController\ConfirmPassword;
use App\Http\Controllers\VendorController\AuthenticatedSessionsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



//vendor
Route::middleware('guest')->group(function () {

Route::get('/vendor', [App\Http\Controllers\VendorController\RegistrationController::class, 'create']);

Route::post('vendor/register', [App\Http\Controllers\VendorController\RegistrationController::class, 'store'])
->name('vendor.register');

Route::get('/vendorlogin', [AuthenticatedSessionsController::class, 'create'])
->name('vendor.login');

Route::post('/vendorlogin', [AuthenticatedSessionsController::class, 'store']);

Route::get('/forgot-vendorpassword', [App\Http\Controllers\VendorController\PasswordResetLinkController::class, 'create'])
                ->name('password.request');

 Route::post('/forgot-vendorpassword', [App\Http\Controllers\VendorController\PasswordResetLinkController::class, 'store'])
                ->name('password.email');

Route::get('reset-vendorpassword/{token}', [App\Http\Controllers\VendorController\NewPasswordController::class, 'create'])
                ->name('password.reset');

Route::post('/reset-vendorpassword', [App\Http\Controllers\VendorController\NewPasswordController::class, 'store'])
                ->name('password.store');

// Google login 
Route::get('login/google', [AuthenticatedSessionsController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [ AuthenticatedSessionsController::class, 'handleGoogleCallback']);

});


//password_reset
Route::middleware('auth')->group(function () {
Route::get('/verify-vendoremail',App\Http\Controllers\VendorController\EmailVerificationPromptController::class)
                ->name('verification.notice');

Route::post('vendoremail/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');


 Route::get('verify-vendoremail/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::get('/confirm-vendorpassword', [App\Http\Controllers\VendorController\ConfirmPassword::class, 'show'])
                ->name('password.confirm');

Route::post('/confirm-vendorpassword', [App\Http\Controllers\VendorController\ConfirmPassword::class, 'store']);

Route::put('/vendorpassword', [App\Http\Controllers\VendorController\PasswordController::class, 'update'])
                ->name('password.update');

                
});
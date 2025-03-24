<?php

use App\Http\Controllers\Coworkers\Authentication\CoworkersAuthController;
use Authentication\Http\Controllers\EmailRegistrationController;
use Authentication\Http\Controllers\ForgetPasswordController;
use Authentication\Http\Controllers\LinkAuthController;
use Authentication\Http\Controllers\OtpAuthController;
use Authentication\Http\Controllers\PasswordController;
use Authentication\Http\Controllers\TwoAuthController;
use Authentication\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/otp'], function () {
    Route::post('/login', [OtpAuthController::class, 'login'])->middleware(['throttle:3,1']);
    Route::post('/verify', [OtpAuthController::class, 'verify']);
});

Route::group(['prefix' => '/auth/password', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/has-password', [PasswordController::class, 'hasPassword']);
    Route::post('/set-password', [PasswordController::class, 'setPassword']);
    Route::post('/send-verification-code', [PasswordController::class, 'sendVerificationCode'])->middleware(['throttle:3,1']);
    Route::post('/login', [PasswordController::class, 'login'])->withoutMiddleware('auth:sanctum');
    Route::post('/reset', [ForgetPasswordController::class, 'reset'])->withoutMiddleware('auth:sanctum');
    Route::post('/reset/verify', [ForgetPasswordController::class, 'verify'])->withoutMiddleware('auth:sanctum');
});

Route::group(['prefix' => '/auth/email'], function () {
    Route::post('/register', [EmailRegistrationController::class, 'register']);
    Route::get('/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/verify/generate', [VerificationController::class, 'sendLink'])->middleware(['auth:sanctum', 'throttle:60,3']);
});

Route::group(['prefix' => '/auth'], function () {
    Route::post('/login-link', [LinkAuthController::class, 'generate']);
    Route::post('/verify-login', [LinkAuthController::class, 'verify']);
});

Route::group(['prefix' => '/twoauth', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/generate-code', [TwoAuthController::class, 'generate']);
    Route::post('/verify-code', [TwoAuthController::class, 'verify']);
});

Route::group(['prefix' => '/auth/coworkers'], function () {
    Route::post('/register', [CoworkersAuthController::class, 'register']);
    Route::post('/login', [CoworkersAuthController::class, 'login'])->middleware(['throttle:3,1']);
    Route::post('/verify', [CoworkersAuthController::class, 'verify']);
});

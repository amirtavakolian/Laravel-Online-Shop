<?php

use Authentication\App\Http\Controllers\EmailRegistrationController;
use Authentication\App\Http\Controllers\ForgetPasswordController;
use Authentication\App\Http\Controllers\LinkAuthController;
use Authentication\App\Http\Controllers\OtpAuthController;
use Authentication\App\Http\Controllers\PasswordController;
use Authentication\App\Http\Controllers\TwoAuthController;
use Authentication\App\Http\Controllers\VerificationController;
use Coworkers\App\Http\Controllers\CoworkersAuthController;
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

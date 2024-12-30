<?php

use App\Http\Controllers\Authentication\EmailRegistrationController;
use App\Http\Controllers\Authentication\OtpAuthController;
use App\Http\Controllers\Authentication\PasswordController;
use App\Http\Controllers\Authentication\VerificationController;
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
});

Route::group(['prefix' => '/auth/email'], function () {

    Route::post('/register', [EmailRegistrationController::class, 'register']);
    Route::get('/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/verify/generate', [VerificationController::class, 'sendLink'])->middleware(['auth:sanctum', 'throttle:60,3']);
});


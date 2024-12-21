<?php

use App\Http\Controllers\Authentication\OtpAuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/otp'], function () {

    Route::post('/login', [OtpAuthController::class, 'login']);
    Route::post('/verify', [OtpAuthController::class, 'verify']);
});

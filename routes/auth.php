<?php

use App\Http\Controllers\Authentication\OTPController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/otp'], function () {

    Route::post('/login', [OTPController::class, 'login']);
    Route::post('/verify', [OTPController::class, 'verify']);
});

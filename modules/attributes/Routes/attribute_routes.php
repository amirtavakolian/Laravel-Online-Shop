<?php

use Attributes\App\Http\Controllers\AttributesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/panel', 'middleware' => 'auth:coworkers'], function () {

    Route::apiResource('/attributes', AttributesController::class);
});

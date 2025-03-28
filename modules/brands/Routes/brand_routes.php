<?php

use Brands\App\Http\Controllers\BrandsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/panel', 'middleware' => 'auth:coworkers'], function () {

    Route::apiResource('/brands', BrandsController::class);
});

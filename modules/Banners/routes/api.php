<?php

use Illuminate\Support\Facades\Route;
use Modules\Banners\app\Http\Controllers\BannersController;

Route::prefix('/panel')->group(function () {
    Route::apiResource('banners', BannersController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Banners\app\Http\Controllers\BannersController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('banners', BannersController::class)->names('banners');
});

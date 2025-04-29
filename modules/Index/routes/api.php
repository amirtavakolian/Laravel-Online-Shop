<?php

use Illuminate\Support\Facades\Route;
use Modules\Index\app\Http\Controllers\IndexController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('indices', IndexController::class)->names('index');
});

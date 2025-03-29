<?php

use Categories\App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoriesController::class);

<?php

use Illuminate\Support\Facades\Route;
use Products\App\Http\Controllers\ProductsController;

Route::apiResource('/products', ProductsController::class);

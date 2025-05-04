<?php

use Illuminate\Support\Facades\Route;
use Modules\Index\app\Http\Controllers\IndexController;

Route::get('index', [IndexController::class, 'index']);

<?php

use Illuminate\Support\Facades\Route;
use Tags\App\Http\Controllers\TagsController;

Route::apiResource('/tags', TagsController::class);

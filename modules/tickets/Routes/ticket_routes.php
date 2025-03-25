<?php

use Illuminate\Support\Facades\Route;
use Tickets\App\Http\Controllers\TicketController;

Route::group(['prefix' => '/panel'], function () {
    Route::apiResource('tickets', TicketController::class)->middleware('auth');

    Route::group(['prefix' => '/tickets'], function () {
        Route::post('/{ticket}/user-answer', [TicketController::class, 'answer'])->middleware('auth');
        Route::post('/{ticket}/close', [TicketController::class, 'close'])->middleware('auth');
        Route::post('/exists/{userId}/{departmentId}', [TicketController::class, 'userTicketHistoryCheck']);
    });
})->middleware('auth:sanctum');

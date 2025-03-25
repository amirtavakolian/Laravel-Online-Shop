<?php

use App\Http\Controllers\Ticket\TicketController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/panel'], function () {
    Route::group(['prefix' => '/tickets'], function () {
        Route::apiResource('/', TicketController::class)->middleware('auth');
        Route::post('/{ticket}/user-answer', [TicketController::class, 'answer'])->middleware('auth');
        Route::post('/{ticket}/close', [TicketController::class, 'close'])->middleware('auth');
        Route::post('/exists/{userId}/{departmentId}', [TicketController::class, 'userTicketHistoryCheck']);
    });



})->middleware('auth:sanctum');

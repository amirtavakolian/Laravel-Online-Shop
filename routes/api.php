<?php

use App\Http\Controllers\Coworkers\CoworkersController;
use App\Http\Controllers\Coworkers\Ticket\SupportTicketController;
use App\Http\Controllers\SupportDepartments\SupportDepartmentsController;
use App\Http\Controllers\Ticket\TicketController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/coworkers', 'middleware' => 'auth:coworkers'], function () {
    Route::post('/addToSupportDepartments', [CoworkersController::class, 'addToSupportDepartments']);
});


Route::group(['prefix' => '/panel'], function () {
    Route::group(['prefix' => '/tickets'], function () {
        Route::apiResource('/', TicketController::class)->middleware('auth');
        Route::post('/{ticket}/user-answer', [TicketController::class, 'answer'])->middleware('auth');
        Route::post('/{ticket}/close', [TicketController::class, 'close'])->middleware('auth');
        Route::post('/exists/{userId}/{departmentId}', [TicketController::class, 'userTicketHistoryCheck']);
    });

    Route::apiResource('support-tickets', SupportTicketController::class)->middleware('auth:coworkers');
    Route::post('support-tickets/coworker/assign', [SupportTicketController::class, 'assign'])->middleware('auth:coworkers');
    Route::post('support-tickets/department/assign', [SupportTicketController::class, 'assignToDepartment'])->middleware('auth:coworkers');

    Route::group(['prefix' => '/departments', 'middleware' => 'auth:coworkers'], function () {
        Route::post('/', [SupportDepartmentsController::class, 'departments']);
        Route::post('/{departmentId}/coworkers', [SupportDepartmentsController::class, 'departmentCoworkers']);
    });
})->middleware('auth:sanctum');

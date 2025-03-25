<?php

use Coworkers\App\Http\Controllers\CoworkersAuthController;
use Coworkers\App\Http\Controllers\CoworkersController;
use Coworkers\App\Http\Controllers\SupportDepartmentsController;
use Coworkers\App\Http\Controllers\SupportTicketController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/panel'], function () {

    Route::group(['prefix' => '/coworkers', 'middleware' => 'auth:coworkers'], function () {
        Route::post('/addToSupportDepartments', [CoworkersController::class, 'addToSupportDepartments']);
    });

    Route::apiResource('support-tickets', SupportTicketController::class)->middleware('auth:coworkers');
    Route::post('support-tickets/coworker/assign', [SupportTicketController::class, 'assign'])->middleware('auth:coworkers');
    Route::post('support-tickets/department/assign', [SupportTicketController::class, 'assignToDepartment'])->middleware('auth:coworkers');

    Route::group(['prefix' => '/departments', 'middleware' => 'auth:coworkers'], function () {
        Route::post('/', [SupportDepartmentsController::class, 'departments']);
        Route::post('/{departmentId}/coworkers', [SupportDepartmentsController::class, 'departmentCoworkers']);
    });

    Route::group(['prefix' => '/auth/coworkers'], function () {
        Route::post('/register', [CoworkersAuthController::class, 'register']);
        Route::post('/login', [CoworkersAuthController::class, 'login'])->middleware(['throttle:3,1']);
        Route::post('/verify', [CoworkersAuthController::class, 'verify']);
    })->middleware('guest');
});



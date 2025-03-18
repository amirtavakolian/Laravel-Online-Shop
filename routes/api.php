<?php

use App\Http\Controllers\Coworkers\CoworkersController;
use App\Http\Controllers\Coworkers\Ticket\SupportTicketController;
use App\Http\Controllers\RolePermission\CoworkerRoleController;
use App\Http\Controllers\RolePermission\RolePermissionController;
use App\Http\Controllers\RolePermission\UserRoleController;
use App\Http\Controllers\RolePermission\PermissionController;
use App\Http\Controllers\RolePermission\RoleController;
use App\Http\Controllers\SupportDepartments\SupportDepartmentsController;
use App\Http\Controllers\Ticket\TicketController;
use App\Models\SupportDepartment;
use Illuminate\Support\Facades\Route;

Route::apiResource('roles', RoleController::class)->middleware('auth:coworkers');
Route::apiResource('permissions', PermissionController::class)->middleware('auth:sanctum');

Route::group(['prefix' => '/users', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/{user}/assign-role', [UserRoleController::class, 'assign']);
    Route::get('/{user}/roles', [UserRoleController::class, 'roles']);
    Route::delete('/{user}/roles', [UserRoleController::class, 'remove']);
});

Route::group(['prefix' => '/coworkers', 'middleware' => 'auth:coworkers'], function () {
    Route::post('/{coworker}/assign-role', [CoworkerRoleController::class, 'assign']);
    Route::get('/{coworker}/roles', [CoworkerRoleController::class, 'roles']);
    Route::delete('/{coworker}/roles', [CoworkerRoleController::class, 'remove']);
    Route::post('/addToSupportDepartments', [CoworkersController::class, 'addToSupportDepartments']);
});

Route::post('/roles/{role}/assign-permission', [RolePermissionController::class, 'assignPermissionToRole'])->middleware('auth:sanctum');

Route::group(['prefix' => '/panel'], function () {
    Route::apiResource('/tickets', TicketController::class);
    Route::post('/tickets/exists/{userId}/{departmentId}', [TicketController::class, 'userTicketHistoryCheck']);

    Route::apiResource('support-tickets', SupportTicketController::class)->middleware('auth:coworkers');
    Route::post('support-tickets/assign', [SupportTicketController::class, 'assign'])->middleware('auth:coworkers');

    Route::group(['prefix' => '/departments', 'middleware' => 'auth:coworkers'], function () {
        Route::post('/', [SupportDepartmentsController::class, 'departments']);
        Route::post('/{departmentId}/coworkers', [SupportDepartmentsController::class, 'departmentCoworkers']);
    });
})->middleware('auth:sanctum');

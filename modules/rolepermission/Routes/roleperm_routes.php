<?php

use Illuminate\Support\Facades\Route;
use RolePermission\App\Http\Controllers\CoworkerRoleController;
use RolePermission\App\Http\Controllers\PermissionController;
use RolePermission\App\Http\Controllers\RoleController;
use RolePermission\App\Http\Controllers\RolePermissionController;
use RolePermission\App\Http\Controllers\UserRoleController;

Route::apiResource('roles', RoleController::class)->middleware('auth:coworkers');
Route::apiResource('permissions', PermissionController::class)->middleware('auth:coworkers');

Route::post('/roles/{role}/assign-permission', [RolePermissionController::class, 'assignPermissionToRole'])->middleware('auth:coworkers');

Route::group(['prefix' => '/users', 'middleware' => 'auth:coworkers'], function () {
    Route::post('/{user}/assign-role', [UserRoleController::class, 'assign']);
    Route::get('/{user}/roles', [UserRoleController::class, 'roles']);
    Route::delete('/{user}/roles', [UserRoleController::class, 'remove']);
});

Route::group(['prefix' => '/coworkers', 'middleware' => 'auth:coworkers'], function () {
    Route::post('/{coworker}/assign-role', [CoworkerRoleController::class, 'assign']);
    Route::get('/{coworker}/roles', [CoworkerRoleController::class, 'roles']);
    Route::delete('/{coworker}/roles', [CoworkerRoleController::class, 'remove']);
});

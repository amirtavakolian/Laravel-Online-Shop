<?php

use App\Http\Controllers\RolePermission\UserRoleController;
use App\Http\Controllers\RolePermission\PermissionController;
use App\Http\Controllers\RolePermission\RoleController;
use Illuminate\Support\Facades\Route;

Route::apiResource('roles', RoleController::class)->middleware('auth:sanctum');
Route::apiResource('permissions', PermissionController::class)->middleware('auth:sanctum');

Route::group(['prefix' => '/users', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/{user}/assign-role', [UserRoleController::class, 'assign']);
    Route::get('/{user}/roles', [UserRoleController::class, 'roles']);
});

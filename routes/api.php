<?php

use App\Http\Controllers\AssignRoleController;
use App\Http\Controllers\RolePermission\PermissionController;
use App\Http\Controllers\RolePermission\RoleController;
use Illuminate\Support\Facades\Route;

Route::apiResource('roles', RoleController::class)->middleware('auth:sanctum');
Route::apiResource('permissions', PermissionController::class)->middleware('auth:sanctum');

Route::group(['prefix' => '/users'], function () {
    Route::post('/{user}/assign-role', [AssignRoleController::class, 'assign']);
})->middleware('auth:sanctum');

<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\StorePermissionsRequest;
use App\Services\ApiResponse\ApiResponseFacade;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

    public function store(StorePermissionsRequest $request)
    {
        $this->authorize('create', Role::class);

        foreach ($request->validated('permissions') as $permission) {
            Permission::query()->create([
                "name" => $permission
            ]);
        }

        return ApiResponseFacade::setMessage(__('messages.role_perm.permissions_has_been_created_successfully'))
            ->build()->response();
    }
}

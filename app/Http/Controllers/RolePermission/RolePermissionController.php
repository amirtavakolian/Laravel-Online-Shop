<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\PermissionsRequest;
use App\Services\ApiResponse\ApiResponseFacade;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{

    public function assignPermissionToRole(PermissionsRequest $request, Role $role)
    {
        $this->authorize('isAdmin', Role::class);

        foreach ($request->validated('permissions') as $permission) {
            $role->revokePermissionTo($permission);
        }

        return ApiResponseFacade::setMessage(__('messages.role_perm.permissions_has_been_assigned_to_role_successfully'))
            ->build()->response();
    }
}

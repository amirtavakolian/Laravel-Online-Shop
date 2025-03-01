<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\AssignRoleRequest;
use App\Http\Requests\RolePermission\RemoveUserRolesRequest;
use App\Models\Coworker;
use App\Services\ApiResponse\ApiResponseFacade;
use Spatie\Permission\Models\Role;

class CoworkerRoleController extends Controller
{

    public function assign(AssignRoleRequest $request, Coworker $coworker)
    {
        $this->authorize('create', Role::class);

        $coworker->syncRoles($request->validated('roles'));

        return ApiResponseFacade::setMessage(__('messages.role_perm.role_has_been_assigned_successfully'))
            ->build()->response();

    }

    public function roles(Coworker $coworker)
    {
        return ApiResponseFacade::setData($coworker->roles->toArray())->build()->response();
    }

    public function remove(RemoveUserRolesRequest $request, Coworker $user)
    {
        $this->authorize('removeRole', Role::class);

        foreach ($request->validated('roles') as $role) {
            $user->removeRole($role);
        }

        return ApiResponseFacade::setMessage(__('messages.role_perm.user_roles_has_been_removed_successfully'))->build()->response();
    }
}

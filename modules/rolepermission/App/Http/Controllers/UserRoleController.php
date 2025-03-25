<?php
namespace RolePermission\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Authentication\App\Models\User;
use RolePermission\App\Http\Requests\AssignRoleRequest;
use RolePermission\App\Http\Requests\RemoveUserRolesRequest;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{

    public function assign(AssignRoleRequest $request, User $user)
    {
        dd(5);
        $this->authorize('assignRole', Role::class);

        $user->syncRoles($request->validated('roles'));

        return ApiResponseFacade::setMessage(__('messages.role_perm.role_has_been_assigned_successfully'))
            ->build()->response();
    }

    public function roles(User $user)
    {
        return ApiResponseFacade::setData($user->roles->toArray())->build()->response();
    }

    public function remove(RemoveUserRolesRequest $request, User $user)
    {
        $this->authorize('removeRole', Role::class);

        foreach ($request->validated('roles') as $role) {
            $user->removeRole($role);
        }

        return ApiResponseFacade::setMessage(__('messages.role_perm.user_roles_has_been_removed_successfully'))->build()->response();
    }
}


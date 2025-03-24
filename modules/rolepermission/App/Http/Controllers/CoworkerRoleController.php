<?php
namespace RolePermission\App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Coworker;
use App\Services\ApiResponse\ApiResponseFacade;
use RolePermission\App\Http\Requests\AssignRoleRequest;
use RolePermission\App\Http\Requests\RemoveUserRolesRequest;
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

    public function remove(RemoveUserRolesRequest $request, Coworker $coworker)
    {
        $this->authorize('removeRole', Role::class);

        foreach ($request->validated('roles') as $role) {
            $coworker->removeRole($role);
        }

        return ApiResponseFacade::setMessage(__('messages.role_perm.user_roles_has_been_removed_successfully'))->build()->response();
    }
}

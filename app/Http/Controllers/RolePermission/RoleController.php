<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\StoreRolesRequest;
use App\Http\Requests\RolePermission\UpdateRoleRequest;
use App\Services\ApiResponse\ApiResponseFacade;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function store(StoreRolesRequest $request)
    {
        $this->authorize('create', Role::class);

        foreach ($request->validated('roles') as $role) {
            Role::query()->create([
                "name" => $role
            ]);
        }

        return ApiResponseFacade::setMessage(__('messages.role_perm.roles_has_been_created_successfully'))
            ->build()->response();
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('update', Role::class);

        $role->update(['name' => $request->validated('role')]);

        return ApiResponseFacade::setMessage(__('messages.role_perm.roles_has_been_updated_successfully'))
            ->build()->response();
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', Role::class);

        $role->delete();

        return ApiResponseFacade::setMessage(__('messages.role_perm.roles_has_been_deleted_successfully'))
            ->build()->response();
    }
}

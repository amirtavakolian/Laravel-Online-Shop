<?php

namespace RolePermission\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\RolePermission\RoleResource;
use App\Services\ApiResponse\ApiResponseFacade;
use Illuminate\Support\Arr;
use RolePermission\App\Http\Requests\StoreRolesRequest;
use RolePermission\App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $this->authorize('create', Role::class);

        $roles = Arr::flatten(RoleResource::collection(Role::all()));

        return ApiResponseFacade::setData($roles)
            ->build()
            ->response();
    }

    public function store(StoreRolesRequest $request)
    {
        $this->authorize('create', Role::class);

        foreach ($request->validated('roles') as $role) {
            Role::query()->create([
                "name" => $role,
                "guard_name" => $request->input('guard_name')
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

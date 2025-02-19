<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\StorePermissionsRequest;
use App\Http\Requests\RolePermission\UpdatePermissionRequest;
use App\Http\Resources\RolePermission\PermissionResource;
use App\Services\ApiResponse\ApiResponseFacade;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('create', Role::class);

        $permissions = PermissionResource::collection(Permission::all());

        return ApiResponseFacade::setData($permissions->toArray($request))->build()->response();
    }

    public function store(StorePermissionsRequest $request)
    {
        $this->authorize('create', Role::class);

        foreach ($request->validated('permissions') as $permission) {
            Permission::query()->create([
                "name" => $permission,
                "guard_name" => $request->input('guard_name')
            ]);
        }

        return ApiResponseFacade::setMessage(__('messages.role_perm.permissions_has_been_created_successfully'))
            ->build()->response();
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $this->authorize('update', Role::class);

        $permission->update(['name' => $request->validated('permission')]);

        return ApiResponseFacade::setMessage(__('messages.role_perm.permissions_has_been_updated_successfully'))
            ->build()->response();
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('delete', Role::class);

        $permission->delete();

        return ApiResponseFacade::setMessage(__('messages.role_perm.permissions_has_been_deleted_successfully'))
            ->build()->response();
    }
}

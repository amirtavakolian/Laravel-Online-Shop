<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\StoreRolesRequest;
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
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolePermission\AssignRoleRequest;
use App\Models\User;
use App\Services\ApiResponse\ApiResponseFacade;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AssignRoleController extends Controller
{

    public function assign(AssignRoleRequest $request, User $user)
    {
        $this->authorize('assignRole', Role::class);

        $user->syncRoles($request->validated('roles'));

        return ApiResponseFacade::setMessage(__('messages.role_perm.role_has_been_assigned_successfully'))
            ->build()->response();
    }

    public function roles(User $user)
    {
        return ApiResponseFacade::setData($user->roles->toArray())->build()->response();
    }
}


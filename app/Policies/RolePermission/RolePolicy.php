<?php

namespace App\Policies\RolePermission;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePolicy
{

    public function create(User $user): bool
    {
        return $user->hasRole(\App\Enum\RolePermission\Role::ADMIN->value);
    }

    public function update(User $user): bool
    {
        return $user->hasRole(\App\Enum\RolePermission\Role::ADMIN->value);
    }

    public function delete(User $user): bool
    {
        return $user->hasRole(\App\Enum\RolePermission\Role::ADMIN->value);
    }

    public function assignRole(User $user): bool
    {
        return $user->hasRole(\App\Enum\RolePermission\Role::ADMIN->value);
    }

    public function removeRole(User $user): bool
    {
        return $user->hasRole(\App\Enum\RolePermission\Role::ADMIN->value);
    }

    public function isAdmin(User $user): bool
    {
        return $user->hasRole(\App\Enum\RolePermission\Role::ADMIN->value);
    }
}

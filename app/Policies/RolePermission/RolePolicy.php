<?php

namespace App\Policies\RolePermission;

use App\Enum\RolePermission\Role;
use App\Models\Coworker;

class RolePolicy
{

    public function before(Coworker $user, string $ability): ?bool
    {
        if ($user->hasRole(Role::SUPER_ADMIN->value)) {
            return true;
        }
        return null;
    }

    public function create(Coworker $user): bool
    {
        return $user->hasRole(Role::SUPER_ADMIN->value);
    }

    public function update(Coworker $user): bool
    {
        return $user->hasRole(Role::SUPER_ADMIN->value);
    }

    public function delete(Coworker $user): bool
    {
        return $user->hasRole(Role::SUPER_ADMIN->value);
    }

    public function assignRole(Coworker $user): bool
    {
        return $user->hasRole(Role::SUPER_ADMIN->value);
    }

    public function removeRole(Coworker $user): bool
    {
        return $user->hasRole(Role::SUPER_ADMIN->value);
    }

    public function isSUPER_ADMIN(Coworker $user): bool
    {
        return $user->hasRole(Role::SUPER_ADMIN->value);
    }
}

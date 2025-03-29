<?php

namespace Categories\App\Policies;

use Coworkers\App\Models\Coworker;
use RolePermission\Enum\Role;

class CategoryPolicy
{
    public function isSuperAdmin(Coworker $coworker)
    {
        return $coworker->hasRole(Role::SUPER_ADMIN->value);
    }
}

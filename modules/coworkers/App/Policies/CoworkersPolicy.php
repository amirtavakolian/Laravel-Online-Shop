<?php

namespace Coworkers\App\Policies;

use Coworkers\App\Models\coworker;
use RolePermission\Enum\Role;

class CoworkersPolicy
{

    public function addCoworkerToDepartments(Coworker $coworker): bool
    {
        return $coworker->hasRole(Role::SUPER_ADMIN->value);
    }
}

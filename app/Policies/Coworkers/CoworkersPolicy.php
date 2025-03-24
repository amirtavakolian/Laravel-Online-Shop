<?php

namespace App\Policies\Coworkers;

use App\Enum\RolePermission\Role;
use App\Models\coworker;

class CoworkersPolicy
{

    public function addCoworkerToDepartments(Coworker $coworker): bool
    {
        return $coworker->hasRole(Role::SUPER_ADMIN->value);
    }
}

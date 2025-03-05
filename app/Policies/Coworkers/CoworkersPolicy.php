<?php

namespace App\Policies\Coworkers;

use App\Enum\RolePermission\Role;
use App\Models\coworker;
use App\Models\User;

class CoworkersPolicy
{

    public function addCoworkerToDepartments(Coworker $coworker): bool
    {
        return $coworker->hasRole(Role::SUPER_ADMIN->value);
    }
}

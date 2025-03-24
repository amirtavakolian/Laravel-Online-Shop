<?php

namespace App\Policies\Coworkers;

use App\Models\coworker;
use Role;

class CoworkersPolicy
{

    public function addCoworkerToDepartments(Coworker $coworker): bool
    {
        return $coworker->hasRole(Role::SUPER_ADMIN->value);
    }
}

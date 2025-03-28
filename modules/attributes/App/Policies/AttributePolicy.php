<?php

namespace Attributes\App\Policies;

use Coworkers\App\Models\Coworker;
use RolePermission\Enum\Role;

class AttributePolicy
{
    public function isSuperAdmin(Coworker $coworker): bool
    {
        return $coworker->hasRole(Role::SUPER_ADMIN->value);
    }
}

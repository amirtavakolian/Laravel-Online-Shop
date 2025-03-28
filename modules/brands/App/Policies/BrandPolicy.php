<?php

namespace Brands\App\Policies;

use Brands\App\Models\Brand;
use Authentication\App\Models\User;
use Coworkers\App\Models\Coworker;
use RolePermission\Enum\Role;

class BrandPolicy
{
    public function isSuperAdmin(Coworker $coworker)
    {
        return $coworker->hasRole(Role::SUPER_ADMIN->value);
    }
}

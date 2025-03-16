<?php

namespace App\Policies\Ticket;

use App\Enum\RolePermission\Role;
use App\Models\Ticket;
use App\Models\Coworker;

class TicketPolicy
{
    public function before(Coworker $user, string $ability): ?bool
    {
        if ($user->hasRole(Role::SUPER_ADMIN->value)) {
            return true;
        }
        return null;
    }

    public function supportCoworkersViewAny(Coworker $coworker): bool
    {
        return $coworker->hasRole(Role::SUPPORT->value);
    }
}

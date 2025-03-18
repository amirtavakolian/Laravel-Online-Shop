<?php

namespace App\Policies\Ticket;

use App\Enum\RolePermission\Role;
use App\Models\Ticket;
use App\Models\Coworker;
use App\Models\User;

class TicketPolicy
{
    public function before(User|Coworker $user, string $ability): ?bool
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

    public function view(User $user, Ticket $ticket): bool
    {
        return $user->id == $ticket->user_id;
    }

    public function update(User $user, Ticket $ticket): bool
    {
        return $user->id == $ticket->user_id;
    }
}

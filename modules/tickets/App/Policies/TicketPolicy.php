<?php

namespace Tickets\App\Policies;

use Authentication\App\Models\User;
use Coworkers\App\Models\Coworker;
use RolePermission\Enum\Role;
use Tickets\App\Models\Ticket;

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

    public function destroy(User $user, Ticket $ticket): bool
    {
        return $user->id == $ticket->user_id;
    }

    public function answer(User $user, Ticket $ticket): bool
    {
        return $user->id == $ticket->user_id;
    }

    public function close(User $user, Ticket $ticket)
    {
        return $user->id == $ticket->user_id;
    }
}

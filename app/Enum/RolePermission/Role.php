<?php

namespace App\Enum\RolePermission;

enum Role: string
{
    case ADMIN = 'admin';
    case SUPER_ADMIN = 'super-admin';
    case SUPPORT = 'support';
}

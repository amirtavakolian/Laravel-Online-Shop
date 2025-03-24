<?php

namespace RolePermission\Enum;

enum Role: string
{
    case ADMIN = 'admin';
    case SUPER_ADMIN = 'super-admin';
    case SUPPORT = 'support';
}

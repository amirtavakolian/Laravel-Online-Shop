<?php

namespace Authentication\App\Enum;

Enum UserStatus: string
{
    case LOCKED = 'locked';
    case ACTIVE = 'active';
    case DEACTIVE = 'deactive';
}

<?php

namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

Enum UserStatus: string
{
    case LOCKED = 'locked';
    case ACTIVE = 'active';
    case DEACTIVE = 'deactive';
}

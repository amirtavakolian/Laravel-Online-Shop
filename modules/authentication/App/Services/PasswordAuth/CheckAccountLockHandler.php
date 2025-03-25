<?php

namespace Authentication\App\Services\PasswordAuth;

use Authentication\App\Enum\UserStatus;

class CheckAccountLockHandler extends PasswordAuthHandler
{

    public function verify(string $mobile, string $password): string
    {
        if($this->currentUser->status == UserStatus::LOCKED->value){
            return __('messages.auth.your_account_is_locked_please_contact_with_support');
        }

        return parent::verify($mobile, $password);
    }
}

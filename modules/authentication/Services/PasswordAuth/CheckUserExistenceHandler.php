<?php

namespace Authentication\Services\PasswordAuth;

class CheckUserExistenceHandler extends PasswordAuthHandler
{

    public function verify(string $mobile, string $password): string
    {
        return is_null($this->currentUser) ? __('messages.auth.account_not_found') : parent::verify($mobile, $password);
    }
}

<?php

namespace App\Services\Authentication\PasswordAuth;

use App\Models\User;

class CheckUserExistenceHandler extends PasswordAuthHandler
{

    public function verify(string $mobile, string $password): string
    {
        return is_null($this->currentUser) ? __('messages.auth.account_not_found') : parent::verify($mobile, $password);
    }
}

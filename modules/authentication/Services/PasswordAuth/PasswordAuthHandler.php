<?php

namespace Authentication\Services\PasswordAuth;

use Authentication\Models\User;

abstract class PasswordAuthHandler
{
    protected $nextHandler;
    protected $currentUser;

    public function __construct(?User $user, PasswordAuthHandler $passwordAuthHandler = null)
    {
        $this->nextHandler = $passwordAuthHandler;
        $this->currentUser = $user;
    }

    public function verify(string $mobile, string $password): string
    {
        if (!$this->nextHandler) {
            return true;
        }

        return $this->nextHandler->verify($mobile, $password);
    }
}

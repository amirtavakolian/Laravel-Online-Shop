<?php

namespace App\Services\Authentication\PasswordAuth;

use App\Enum\Authentication;
use App\Enum\UserStatus;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class ValidatePasswordHandler extends PasswordAuthHandler
{

    public function verify(string $mobile, string $password): string
    {
        if (!Hash::check($password, $this->currentUser->password)) {

            $wrongPasswordCounter = Redis::get($mobile .'_'. Authentication::WRONG_PASSWORD_COUNTER->value);

            if ($wrongPasswordCounter == 5) {
                $this->currentUser->status = UserStatus::LOCKED->value;
                $this->currentUser->save();
                return __('messages.auth.account_lock_because_of_to_many_wrong_password');
            }

            Redis::incr($mobile .'_'. Authentication::WRONG_PASSWORD_COUNTER->value);

            return __('messages.auth.user_or_password_is_wrong');
        }

        return parent::verify($mobile, $password);
    }
}

<?php

namespace App\Services\Authentication\PasswordAuth;

use App\Enum\Authentication;
use App\Models\User;
use App\Services\ApiResponse\ApiResponseFacade;
use Illuminate\Support\Facades\Redis;

class PasswordAuthService
{
    public function login(string $mobile, string $password)
    {
        $loginResult = $this->buildPasswordVerifyChain($mobile)->verify($mobile, $password);

        if (strlen($loginResult) > 1) {
            return ApiResponseFacade::setMessage($loginResult)->setStatus(419)->build()->response();
        }

        Redis::del($mobile . '_' . Authentication::WRONG_PASSWORD_COUNTER->value);

        $token = User::query()->where('mobile', $mobile)->first()->createToken('API')->plainTextToken;

        return ApiResponseFacade::setData(['token' => $token])->build()->response();
    }

    private function buildPasswordVerifyChain($mobile)
    {
        $currentUser = User::query()->where('mobile', $mobile)->first();

        $validatePasswordHandler = new ValidatePasswordHandler($currentUser);
        $checkAccountLockHandler = new CheckAccountLockHandler($currentUser, $validatePasswordHandler);
        return new CheckUserExistenceHandler($currentUser,$checkAccountLockHandler);
    }
}

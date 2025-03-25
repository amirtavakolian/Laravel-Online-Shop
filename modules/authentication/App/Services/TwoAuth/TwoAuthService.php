<?php

namespace Authentication\App\Services\TwoAuth;

use App\Services\ApiResponse\ApiResponseFacade;
use Authentication\App\Enum\Authentication;
use Illuminate\Support\Facades\Redis;

class TwoAuthService
{

    public function generate(string $twoAuthMethod)
    {
        $validateTwoAuthMethod = $this->validateTwoAuthMethod($twoAuthMethod, auth()->user());

        if (is_string($validateTwoAuthMethod)) {
            return ApiResponseFacade::setMessage(__('messages.auth.' . $validateTwoAuthMethod))->build()->response();
        }

        resolve(TwoAuth::class, [$twoAuthMethod])->send();

        return Redis::ttl(Authentication::getTwoAuthKey(auth()->user()->id));
    }

    private function validateTwoAuthMethod($twoAuthMethod, $currentUser)
    {
        $message = match ($twoAuthMethod) {
            Authentication::SEND_TWO_AUTH_BY_EMAIL->value => !$currentUser->email ? 'email_not_set' : true,
            Authentication::SEND_TWO_AUTH_BY_SMS->value => !$currentUser->mobile ? 'mobile_not_set' : true,
            Authentication::SEND_TWO_AUTH_BY_CALL->value => !$currentUser->mobile ? 'mobile_not_set' : true,
        };

        return $message ?? true;
    }

    public function verify($userInputCode)
    {
        $message = "";

        $twoAuthCode = Redis::get(Authentication::getTwoAuthKey(auth()->user()->id));

        if (!$twoAuthCode || $twoAuthCode != $userInputCode) {
            $message = __('messages.auth.wrong_two_auth_code');
        } else {
            Redis::setex(auth()->user()->id . '.' . Authentication::TWO_AUTH->value, 300, 1);
            Redis::del(Authentication::getTwoAuthKey(auth()->user()->id));
        }
        return ApiResponseFacade::setMessage($message)->build()->response();
    }
}

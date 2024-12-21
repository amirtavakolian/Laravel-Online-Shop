<?php

namespace App\Services\Authentication;

use App\Models\User;
use App\Services\SMS\KavenegarService;
use Illuminate\Support\Facades\Redis;

class OtpAuthService
{
    const OTP_IS_CURRENLTY_GENERATED = 'otp_is_currently_generated';
    const OTP_CODE_IS_SENT = 'enterance_code_is_sent';
    const OTP_CODE_IS_EXPIRED = 'your_enterance_code_is_expired';
    const OTP_CODE_IS_WRONG = 'otp_code_is_wrong';

    public function __construct(private KavenegarService $kavenegarService)
    {
    }

    public function login($mobile)
    {
        if ($this->isOtpGenerated($mobile)) return self::OTP_IS_CURRENLTY_GENERATED;

        $this->generateOtpCode($mobile);

        $this->kavenegarService->sendOtpCode($mobile, $this->getOtpCode($mobile));

        return self::OTP_CODE_IS_SENT;
    }

    public function verify($mobile, $userOtp)
    {
        $generatedOtpCode = $this->getOtpCode($mobile);

        if (is_null($generatedOtpCode)) $message = __('messages.auth.' . self::OTP_CODE_IS_EXPIRED);

        if (!is_null($generatedOtpCode) && $generatedOtpCode != $userOtp) $message = __('messages.auth.' . self::OTP_CODE_IS_WRONG);

        if (!isset($message)) {
            $this->removeOtpCode($mobile);
            $token = User::query()->firstOrCreate(['mobile' => $mobile], [])->createToken('API')->plainTextToken;
        }

        return [
            'message' => $message ?? '',
            'token' => $token ?? ''
        ];
    }

    private function isOtpGenerated($mobile)
    {
        return Redis::ttl($mobile . '_otp') > 20;
    }

    private function generateOtpCode($mobile)
    {
        Redis::setex($mobile . '_otp', 120, rand(1000, 9999));
    }

    private function getOtpCode($mobile)
    {
        return Redis::get($mobile . '_otp');
    }

    private function removeOtpCode($mobile)
    {
        return Redis::del($mobile . '_otp');
    }
}

<?php

namespace App\Services\Authentication;

use App\Models\User;
use App\Services\SMS\KavenegarService;
use App\Services\SMS\SmsMessage;
use Illuminate\Support\Facades\Redis;

class OtpAuthService
{
    const OTP_IS_CURRENLTY_GENERATED = 'otp_is_currently_generated';
    const OTP_CODE_IS_SENT = 'enterance_code_is_sent';
    const OTP_CODE_IS_EXPIRED = 'your_enterance_code_is_expired';
    const OTP_CODE_IS_WRONG = 'otp_code_is_wrong';

    public function __construct()
    {
    }

    public function sendOtp($mobile)
    {
        if (Redis::ttl($mobile . '_otp') > 20) return self::OTP_IS_CURRENLTY_GENERATED;

        Redis::setex($mobile . '_otp', 120, rand(1000, 9999));

        $smsMessage = resolve(SmsMessage::class)
            ->setMessage(__('messages.auth.your_login_code', ['code' => Redis::get($mobile . '_otp')]))
            ->setReceptor($mobile);

        resolve(KavenegarService::class, ['smsMessage' => $smsMessage])->send();

        return self::OTP_CODE_IS_SENT;
    }

    public function verify($mobile, $userOtp)
    {
        $generatedOtpCode = Redis::get($mobile . '_otp');

        if (is_null($generatedOtpCode)) $message = __('messages.auth.' . self::OTP_CODE_IS_EXPIRED);

        if (!is_null($generatedOtpCode) && $generatedOtpCode != $userOtp) $message = __('messages.auth.' . self::OTP_CODE_IS_WRONG);

        return $message ?? null;
    }

    public function removeOtpCode($mobile)
    {
        return Redis::del($mobile . '_otp');
    }
}

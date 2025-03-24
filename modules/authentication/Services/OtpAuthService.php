<?php

namespace Authentication\Services;

use App\Services\SMS\KavenegarService;
use App\Services\SMS\SmsMessage;
use Illuminate\Support\Facades\Redis;

class OtpAuthService
{
    const OTP_IS_CURRENLTY_GENERATED = 'otp_is_currently_generated';
    const OTP_CODE_IS_SENT = 'enterance_code_is_sent';
    const OTP_CODE_IS_EXPIRED = 'your_enterance_code_is_expired';
    const OTP_CODE_IS_WRONG = 'otp_code_is_wrong';
    const REDIS_OTP_CODE_PREFIX = '_otp';

    public function __construct()
    {
    }

    public function sendOtp($mobile)
    {
        if (Redis::ttl($mobile . self::REDIS_OTP_CODE_PREFIX) > 20) return self::OTP_IS_CURRENLTY_GENERATED;

        Redis::setex($mobile . self::REDIS_OTP_CODE_PREFIX, 120, rand(100000, 999999));

        $smsMessage = resolve(SmsMessage::class)
            ->setMessage(__('messages.auth.your_login_code', ['code' => Redis::get($mobile . self::REDIS_OTP_CODE_PREFIX)]))
            ->setReceptor($mobile);

        // todo: use queue job for sending sms
        resolve(KavenegarService::class, ['smsMessage' => $smsMessage])->send();

        return self::OTP_CODE_IS_SENT;
    }

    public function verify($mobile, $userOtp)
    {
        // todo: if more then 5 times wrong code, remove the code and wait for 2 minutes
        $generatedOtpCode = Redis::get($mobile . self::REDIS_OTP_CODE_PREFIX);

        if (is_null($generatedOtpCode)) $message = __('messages.auth.' . self::OTP_CODE_IS_EXPIRED);

        if (!is_null($generatedOtpCode) && $generatedOtpCode != $userOtp) $message = __('messages.auth.' . self::OTP_CODE_IS_WRONG);

        return $message ?? null;
    }

    public function removeOtpCode($mobile)
    {
        return Redis::del($mobile . self::REDIS_OTP_CODE_PREFIX);
    }
}

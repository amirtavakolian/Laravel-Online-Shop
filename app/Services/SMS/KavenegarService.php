<?php

namespace App\Services\SMS;

use Exception;
use Illuminate\Support\Facades\Log;
use Kavenegar\KavenegarApi;

class KavenegarService
{

    public function __construct(private SmsMessage $smsMessage)
    {
    }

    public function sendOtpCode($mobile, $otpCode)
    {
        $this->generateOtpSmsMessage($mobile, $otpCode);

        try {
            $api = new KavenegarApi(env('KAVENEGAR_API'));
            // $api->send([], $this->smsMessage->getReceptor(), $this->smsMessage->getMessage());
            Log::info($otpCode);

        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }

    private function generateOtpSmsMessage($mobile, $otpCode)
    {
        $this->smsMessage->setMessage(__('messages.auth.your_login_code', ['code' => $otpCode]))
            ->setReceptor($mobile);
    }
}

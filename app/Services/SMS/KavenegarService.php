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

        $this->send($otpCode);
    }

    private function generateOtpSmsMessage($mobile, $otpCode)
    {
       resolve(SmsMessage::class)->setMessage(__('messages.auth.your_login_code', ['code' => $otpCode]))
            ->setReceptor($mobile);
    }

    public function send()
    {
        try {
            $api = new KavenegarApi(env('KAVENEGAR_API'));
            // $api->send([], $this->smsMessage->getReceptor(), $this->smsMessage->getMessage());
            Log::info($this->smsMessage->getMessage());

        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}

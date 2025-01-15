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

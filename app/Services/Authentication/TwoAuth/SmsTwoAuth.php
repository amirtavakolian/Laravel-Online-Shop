<?php

namespace App\Services\Authentication\TwoAuth;

use App\Enum\Authentication;
use App\Services\SMS\KavenegarService;
use App\Services\SMS\SmsMessage;
use Redis;

class SmsTwoAuth extends TwoAuth
{

    public function send()
    {
        $smsMessage = resolve(SmsMessage::class)
            ->setReceptor(auth()->user()->mobile)
            ->setMessage(__('messages.auth.your_two_auth_code', ['code' => $this->storeCode()]));

        resolve(KavenegarService::class, ['smsMessage' => $smsMessage])->send();
    }

}

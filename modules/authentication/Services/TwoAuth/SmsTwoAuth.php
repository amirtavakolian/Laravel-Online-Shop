<?php

namespace Authentication\Services\TwoAuth;

use App\Services\SMS\KavenegarService;
use App\Services\SMS\SmsMessage;

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

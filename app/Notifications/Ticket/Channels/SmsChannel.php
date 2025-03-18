<?php

namespace App\Notifications\Ticket\Channels;

use App\Services\SMS\KavenegarService;
use App\Services\SMS\SmsMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SmsChannel
{
    public function send(object $notifiable, Notification $notification): void
    {
        $smsMessage = resolve(SmsMessage::class);

        app()->bind(SmsMessage::class, fn() => $smsMessage);

        $smsService = resolve(KavenegarService::class);

        $smsMessage->setReceptor($notifiable->mobile);

        $smsMessage->setMessage($notification->toSms($notifiable));

        $smsService->send();
    }
}


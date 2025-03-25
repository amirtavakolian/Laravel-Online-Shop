<?php

namespace Tickets\App\Notifications\Channels;

use App\Services\SMS\KavenegarService;
use App\Services\SMS\SmsMessage;
use Illuminate\Notifications\Notification;

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


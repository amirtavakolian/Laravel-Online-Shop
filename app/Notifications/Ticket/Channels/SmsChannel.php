<?php

namespace App\Notifications\Ticket\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SmsChannel
{

    public function send(object $notifiable, Notification $notification): void
    {
        $message = $notification->toSms($notifiable);

        Log::info($message);
    }
}


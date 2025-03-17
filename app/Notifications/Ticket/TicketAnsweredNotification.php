<?php

namespace App\Notifications\Ticket;

use App\Notifications\Ticket\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class TicketAnsweredNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return [SmsChannel::class];
    }

    public function toSms()
    {
        return [
            'test' => 'test'
        ];
    }
}

<?php

namespace Tickets\App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Tickets\App\Notifications\Channels\SmsChannel;

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
        return __('messages.tickets.your_ticket_is_answered');
    }
}

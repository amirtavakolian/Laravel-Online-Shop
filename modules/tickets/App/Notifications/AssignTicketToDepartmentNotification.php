<?php

namespace Tickets\App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Tickets\App\Notifications\Channels\SmsChannel;

class AssignTicketToDepartmentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $department, public $fromCoworker)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toSms(object $notifiable)
    {
        return __('messages.tickets.a_ticket_from_a_coworker_assigned_to_another_department', [
            'from_coworker' => $this->fromCoworker->fullname,
            'support' => $this->department->name
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

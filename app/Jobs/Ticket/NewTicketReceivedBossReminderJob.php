<?php

namespace App\Jobs\Ticket;

use App\Services\SMS\KavenegarService;
use App\Services\SMS\SmsMessage;
use Coworkers\App\Models\Coworker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Role;

class NewTicketReceivedBossReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $event)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->event->ticket->is_opened) {
            return;
        }

        $admins = Coworker::query()->whereHas('roles', function ($q) {
            $q->where('name', Role::SUPER_ADMIN->value);
        });

        $smsMessage = resolve(SmsMessage::class);
        app()->bind(SmsMessage::class, fn() => $smsMessage);

        $kavenegarService = resolve(KavenegarService::class);

        $admins->each(function ($coworker) use ($smsMessage, $kavenegarService) {
            $smsMessage->setMessage(__('messages.notifications.remind_boss_after_15_minutes'))
                ->setReceptor($coworker->mobile);
            $kavenegarService->send();
        });


        // check kon ticket baz shode ya na (is_opened)
        // age baz nashode bod baiad liste karmandaie un postion E poshtibani gerefte beshe
        // vase hamashon sms bere
        // job E => TicketNotReadNotifToBosJob => ejra beshe bad az 15 min dg
        // check kone age is_opened nashode bod un ticket => be boss sms bere in دفعه
    }
}

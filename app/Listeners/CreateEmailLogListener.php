<?php

namespace App\Listeners;

use App\Events\CreateEmailLogEvent;
use App\Repositories\EmailRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateEmailLogListener implements ShouldQueue
{
    private $emailDep;

    public function __construct(EmailRepository $dep)
    {
        $this->emailDep = $dep;
    }

    public function handle(CreateEmailLogEvent $event)
    {
        $emailData = $this->mapEmailData($event->payload, $event->platformStatus);
        $this->emailDep->createEmail($emailData);
    }

    public function mapEmailData($payload, $platformStatus)
    {
        $toAddresses = [];
        foreach ($payload["to"] as $to) {
            array_push($toAddresses, $to["Email"]);
        }
        $payload["platform"] = $platformStatus;
        $payload["to"] = $toAddresses;
        return $payload;
    }
}

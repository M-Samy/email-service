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
        $emailMappedData = $this->mapEmailData($event->payload, $event->platformStatus);
        $this->emailDep->createEmail($emailMappedData);
    }

    public function mapEmailData($payload, $platformStatus)
    {
        $toAddresses = [];
        $mappedData = [];
        foreach ($payload->get_toAddress() as $to) {
            array_push($toAddresses, $to);
        }
        $mappedData["to"] = $toAddresses;
        $mappedData["subject"] = $payload->get_subject();
        $mappedData["message"] = $payload->get_message();
        $mappedData["platform"] = $platformStatus;
        return $mappedData;
    }
}

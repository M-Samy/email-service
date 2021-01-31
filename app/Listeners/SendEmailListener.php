<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use App\Platforms\PlatformContext;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class SendEmailListener implements ShouldQueue
{
    public function handle(SendEmailEvent $event)
    {
        $platformContext = new PlatformContext();
        $platformContext->sendContextEmail(Config::get("constants.options.default_email_service"), $event->payload);
    }
}

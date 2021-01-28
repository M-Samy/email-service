<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use App\Platforms\PlatformContext;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailListener implements ShouldQueue
{
    public function handle(SendEmailEvent $event)
    {
        $platformContext = new PlatformContext();
        $platformContext->sendContextEmail(env('DEFAULT_EMAIL_SERVICE'), $event->payload);
    }
}

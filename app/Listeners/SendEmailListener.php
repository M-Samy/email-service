<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use App\Platforms\PlatformContext;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param SendEmailEvent $event
     * @return void
     */
    public function handle(SendEmailEvent $event)
    {
        $platformContext = new PlatformContext(env('DEFAULT_EMAIL_SERVICE'));
        $platformContext->sendContextEmail($event->payload);
    }
}

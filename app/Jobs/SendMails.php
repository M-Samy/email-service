<?php

namespace App\Jobs;

use App\Events\CreateEmailLogEvent;
use App\Platforms\PlatformContext;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class SendMails implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $payload;

    /**
     * Create a new job instance.
     *
     * @param $payload
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $platform = Config::get("constants.options.default_email_service");

        $platformContext = new PlatformContext();
        $responseStatus = $platformContext->sendContextEmail($platform, $this->payload);

        $platformStatus[$platform] = $responseStatus;

        if (!$responseStatus) {
            $platform = Config::get("constants.options.fallback_email_service");
            $responseStatus = $platformContext->sendContextEmail($platform, $this->payload);
            $platformStatus[$platform] = $responseStatus;
        }

        event(new CreateEmailLogEvent($this->payload, $platformStatus));

    }
}

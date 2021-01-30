<?php

namespace App\Jobs;

use App\Platforms\PlatformContext;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        $platformContext = new PlatformContext();
        $responseStatus = $platformContext->sendContextEmail(env('DEFAULT_EMAIL_SERVICE'), $this->payload);
        if (!$responseStatus) {
            print_r("Exception occurred");
        }
    }
}

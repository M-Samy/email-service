<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateEmailLogEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    public $payload;
    public $platformStatus;

    /**
     * Create a new event instance.
     *
     * @param $payload
     * @param $platformStatus
     */
    public function __construct($payload, $platformStatus)
    {
        $this->payload = $payload;
        $this->platformStatus = $platformStatus;
    }
}

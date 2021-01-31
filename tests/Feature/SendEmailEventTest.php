<?php

namespace Tests\Unit;

use App\Events\SendEmailEvent;
use App\Http\Resources\Emails\Payload;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SendEmailEventTest extends TestCase
{
    /**
     * Test fire sending emails event.
     *
     * @return void
     * @throws \Exception
     */
    public function testDispatchSendEmailEvent()
    {
        $to = ["example1@example.com", "example2@example.com"];
        $subject = "example subject";
        $message = "example message";
        $markdown = "<p>example markdown</p>";

        $payload = new Payload(
            $to,
            $subject,
            $message,
            $markdown
        );

        $this->expectsEvents(SendEmailEvent::class);

        event(new SendEmailEvent($payload));
    }

    /**
     * Test unable to fire sending emails event.
     *
     * @return void
     */
    public function testNotDispatchSendEmailJob()
    {
        Event::fake();
        Event::assertNotDispatched(SendEmailEvent::class);
    }

}

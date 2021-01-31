<?php

namespace Tests\Unit;

use App\Http\Resources\Emails\Payload;
use App\Jobs\SendMails;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class SendEmailJobTest extends TestCase
{
    /**
     * Test dispatch sending emails job.
     *
     * @return void
     */
    public function testDispatchSendEmailJob()
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

        $this->expectsJobs(SendMails::class);

        dispatch(new SendMails($payload));
    }

    /**
     * Test not dispatching sending emails job.
     *
     * @return void
     */
    public function testNotDispatchSendEmailJob()
    {
        Bus::fake();
        Bus::assertNotDispatched(SendMails::class);
    }

}

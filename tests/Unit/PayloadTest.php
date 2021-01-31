<?php

namespace Tests\Unit;

use App\Http\Resources\Emails\Payload;
use Tests\TestCase;

class PayloadTest extends TestCase
{
    /**
     * Test initialized payload instance.
     *
     * @return void
     */
    public function testInitializePayload()
    {
        $payload = $this->getInstance();
        $this->assertInstanceOf(Payload::class, $payload);
    }

    /**
     * Test set attribute into an instance.
     *
     * @return void
     */
    public function testSetMessagePayload()
    {
        $updatedMessage = "Message Updated";

        $payload = $this->getInstance();

        $payload->set_message($updatedMessage);

        $this->assertEquals($updatedMessage, $payload->get_message());
    }

    /**
     * Private function create an instance.
     *
     * @return Payload
     */

    private function getInstance()
    {
        $to = ["example1@example.com", "example2@example.com"];
        $subject = "example subject";
        $message = "example message";
        $markdown = "<p>example markdown</p>";

        return new Payload(
            $to,
            $subject,
            $message,
            $markdown
        );
    }

}

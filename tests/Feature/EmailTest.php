<?php

namespace Tests\Unit;

use App\Http\Resources\Emails\Payload;
use App\Platforms\PlatformContext;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class EmailTest extends TestCase
{
    /**
     * Test sending mailjet email.
     *
     * @return void
     */
    public function testSendMailJetEmail()
    {
        $payload = $this->getInstance();
        $platformContext = new PlatformContext();
        $responseStatus = $platformContext->sendContextEmail(
            Config::get("constants.platforms.mailjet_platform"),
            $payload
        );

        $this->assertTrue($responseStatus);
    }

    /**
     * Test sending sendgrid email.
     *
     * @return void
     */
    public function testSendGridEmail()
    {
        $payload = $this->getInstance();
        $platformContext = new PlatformContext();
        $responseStatus = $platformContext->sendContextEmail(
            Config::get("constants.platforms.sendgrid_platform"),
            $payload
        );

        $this->assertTrue($responseStatus);
    }

    /**
     * Test send email using un supported platform.
     *
     * @return void
     */
    public function testSendEmailUsingUnSupportedPlatform()
    {
        $payload = $this->getInstance();
        $platformContext = new PlatformContext();
        $responseStatus = $platformContext->sendContextEmail(
            Config::get("constants.platforms.un_supported_platform"),
            $payload
        );

        $this->assertNull($responseStatus);
    }

    private function getInstance()
    {
        $to = ["example@example.com"];
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

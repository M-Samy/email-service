<?php

namespace Tests\Unit;

use App\Platforms\MailjetPlatform;
use Illuminate\Support\Facades\Config;
use Mailjet\Client;
use Tests\TestCase;

class MailjetPlatformTest extends TestCase
{
    /**
     * Test initialized platform name.
     *
     * @return void
     */
    public function testPlatformName()
    {
        $mailjetPlatform = new MailjetPlatform();
        $platformName = $mailjetPlatform->getPlatformName();
        $this->assertEquals(Config::get("constants.platforms.mailjet_platform"), $platformName);
    }

    /**
     * Test initialized connection.
     *
     * @return void
     */
    public function testPlatformConnection()
    {
        MailjetPlatform::initConnectionClient(
            Config::get("constants.platforms.integration_keys.mailjet_api_key"),
            Config::get("constants.platforms.integration_keys.mailjet_api_secret")
        );

        $this->assertInstanceOf(Client::class, MailjetPlatform::$client);
    }
}

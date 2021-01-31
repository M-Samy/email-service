<?php

namespace Tests\Unit;

use App\Platforms\SendGridPlatform;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use SendGrid;

class SendGridPlatformTest extends TestCase
{
    /**
     * Test initialized platform name.
     *
     * @return void
     */
    public function testPlatformName()
    {
        $sendgridPlatform = new SendGridPlatform();
        $platformName = $sendgridPlatform->getPlatformName();
        $this->assertEquals(Config::get("constants.platforms.sendgrid_platform"), $platformName);
    }

    /**
     * Test initialized connection.
     *
     * @return void
     */
    public function testPlatformConnection()
    {
        SendGridPlatform::initConnectionClient(
            Config::get("constants.platforms.integration_keys.sendgrid_api_key")
        );

        $this->assertInstanceOf(SendGrid::class, SendGridPlatform::$client);
    }
}

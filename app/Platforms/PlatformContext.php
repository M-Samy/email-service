<?php


namespace App\Platforms;


use Illuminate\Support\Facades\Config;

class PlatformContext
{
    public function sendContextEmail($platform_name, $payload)
    {
        switch ($platform_name) {
            case Config::get("constants.platforms.mailjet_platform"):
                $responseStatus = MailjetPlatform::sendEmail($payload);
                break;
            case Config::get("constants.platforms.sendgrid_platform"):
                $responseStatus = SendGridPlatform::sendEmail($payload);
                break;
            default:
                $responseStatus = Null;
        }

        return $responseStatus;
    }
}
<?php


namespace App\Platforms;


class PlatformContext
{
    public function sendContextEmail($platform_name, $payload)
    {
        switch ($platform_name) {
            case env('MAIL_JET_SERVICE'):
                $responseStatus = MailjetPlatform::sendEmail($payload);
                break;
            case env('SEND_GRID_SERVICE'):
                $responseStatus = SendGridPlatform::sendEmail($payload);
                break;
            default:
                $responseStatus = Null;
        }

        return $responseStatus;
    }
}
<?php


namespace App\Platforms;


class PlatformContext
{
    public function sendContextEmail($platform_name, $payload)
    {
        switch ($platform_name) {
            case env('MAIL_JET_SERVICE'):
                MailjetPlatform::sendEmail($payload);
                break;
            case env('SEND_GRID_SERVICE'):
                SendGridPlatform::sendEmail($payload);
                break;
        }
    }
}
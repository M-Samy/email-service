<?php


namespace App\Platforms;


class SendGridPlatform implements PlatformInterface
{
    public static function sendEmail($payload)
    {
        $template = self::buildTemplate($payload);
        print_r("sendgrid");
        dd($template);
        return;
    }

    public static function buildTemplate($payload)
    {
        return [];
    }

    public static function initConnectionClient()
    {
        return [];
    }
}
<?php


namespace App\Platforms;


class MailjetPlatform implements PlatformInterface
{

    public function sendEmail($payload)
    {
        print_r("mailjet");
        dd($payload);
        return;
    }
}
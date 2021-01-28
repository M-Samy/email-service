<?php


namespace App\Platforms;


class SendGridPlatform implements PlatformInterface
{

    public function sendEmail($payload)
    {
        print_r("sendgrid");
        dd($payload);
        return;
    }
}
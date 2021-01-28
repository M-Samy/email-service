<?php


namespace App\Platforms;


class PlatformContext
{
    private $strategy = NULL;

    public function __construct($platform_name)
    {
        switch ($platform_name) {
            case env('MAIL_JET_SERVICE'):
                $this->strategy = new MailjetPlatform();
                break;
            case env('SEND_GRID_SERVICE'):
                $this->strategy = new SendGridPlatform();
                break;
        }
    }

    public function sendContextEmail($payload)
    {
        $this->strategy->sendEmail($payload);
    }
}
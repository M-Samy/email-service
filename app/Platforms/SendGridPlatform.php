<?php


namespace App\Platforms;


use Illuminate\Support\Facades\Config;
use SendGrid;
use SendGrid\Mail\Mail;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class SendGridPlatform implements PlatformInterface
{
    public static $client;

    public function getPlatformName()
    {
        return Config::get("constants.platforms.sendgrid_platform");
    }

    public static function sendEmail($payload)
    {
        try {
            self::initConnectionClient();
            $template = self::buildTemplate($payload);
            $response = self::$client->send($template);
            return $response->statusCode() == Response::HTTP_ACCEPTED ? true : false;
        } catch (Exception $exception) {
            return false;
        }
    }

    public static function buildTemplate($payload)
    {
        $email = new Mail();
        $email->setFrom(
            Config::get("constants.email_options.mail_from_address"),
            Config::get("constants.email_options.mail_from_name")
        );
        $email->setSubject($payload->get_subject());
        $toAddresses = [];

        foreach ($payload->get_toAddress() as $toAddress) {
            $toAddresses[$toAddress] = "";
        }

        $email->addTos($toAddresses);
        $email->addContent("text/plain", $payload->get_message());
        $email->addContent(
            "text/html", "<h3>Dears, welcome to SendGrid!</h3><br />" . $payload->get_message() . ""
        );

        return $email;
    }

    public static function initConnectionClient()
    {
        self::$client = new SendGrid(Config::get("constants.platforms.integration_keys.sendgrid_api_key"));
    }
}
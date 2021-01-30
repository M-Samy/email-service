<?php


namespace App\Platforms;


use SendGrid;
use SendGrid\Mail\Mail;
use Symfony\Component\HttpFoundation\Response;

class SendGridPlatform implements PlatformInterface
{
    public static $client;

    public static function sendEmail($payload)
    {
        self::initConnectionClient();
        $template = self::buildTemplate($payload);
        $response = self::$client->send($template);
        return $response->statusCode() == Response::HTTP_ACCEPTED ? true : false;
    }

    public static function buildTemplate($payload)
    {
        $email = new Mail();
        $email->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $email->setSubject($payload->get_subject());
        $toAddresses = [];

        foreach ($payload->get_toAddress() as $toAddress) {
            array_push($toAddresses, array("Email" => $toAddress));
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
        self::$client = new SendGrid(getenv('SENDGRID_API_KEY'));
    }
}
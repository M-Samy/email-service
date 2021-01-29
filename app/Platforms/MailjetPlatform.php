<?php


namespace App\Platforms;


use Mailjet\Client;
use Mailjet\Resources;

class MailjetPlatform implements PlatformInterface
{
    public static $client;

    public static function sendEmail($payload)
    {
        self::initConnectionClient();
        $template = self::buildTemplate($payload);
        $response = self::$client->post(Resources::$Email, ['body' => $template]);;
        $response->success() && dd($response->getData());
    }

    public static function buildTemplate($payload)
    {
        return [
            'Messages' => [
                [
                    'From' => [
                        'Email' => env('MAIL_FROM_ADDRESS'),
                        'Name' => env('MAIL_FROM_NAME')
                    ],
                    'To' => $payload["to"],
                    'Subject' => $payload["subject"],
                    'TextPart' => $payload["message"]
                ]
            ]
        ];
    }

    public static function initConnectionClient()
    {
        self::$client = new Client(
            env('MAILJET_APIKEY'),
            env('MAILJET_APISECRET'),
            true,
            ['version' => 'v3.1']
        );
    }
}
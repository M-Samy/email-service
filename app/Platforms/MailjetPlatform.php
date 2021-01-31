<?php


namespace App\Platforms;


use Illuminate\Support\Facades\Config;
use Mailjet\Client;
use Mailjet\Resources;
use Exception;

class MailjetPlatform implements PlatformInterface
{
    public static $client;

    public static function getPlatformName()
    {
        return Config::get("constants.platforms.mailjet_platform");
    }

    public static function sendEmail($payload)
    {
        try {
            self::initConnectionClient();
            $template = self::buildTemplate($payload);
            $response = self::$client->post(Resources::$Email, ['body' => $template]);
            return $response->success() ? true : false;
        } catch (Exception $exception) {
            return false;
        }
    }

    public static function buildTemplate($payload)
    {
        $toAddresses = [];

        foreach ($payload->get_toAddress() as $toAddress) {
            array_push($toAddresses, array("Email" => $toAddress));
        }

        return [
            'Messages' => [
                [
                    'From' => [
                        'Email' => Config::get("constants.email_options.mail_from_address"),
                        'Name' => Config::get("constants.email_options.mail_from_name")
                    ],
                    'To' => $toAddresses,
                    'Subject' => $payload->get_subject(),
                    'TextPart' => $payload->get_message(),
                    'HTMLPart' => "<h3>Dears, welcome to Mailjet!</h3><br />" . $payload->get_message() . "",
                ]
            ]
        ];
    }

    public static function initConnectionClient()
    {
        self::$client = new Client(
            Config::get("constants.platforms.integration_keys.mailjet_api_key"),
            Config::get("constants.platforms.integration_keys.mailjet_api_secret"),
            true,
            ['version' => 'v3.1']
        );
    }
}
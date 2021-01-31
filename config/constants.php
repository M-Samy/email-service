<?php
return [
    'platforms' => [
        'mailjet_platform' => 'MailJet',
        'sendgrid_platform' => 'SendGrid',
        'un_supported_platform' => 'un supported',
        'integration_keys' => [
            'sendgrid_api_key' => env('SENDGRID_API_KEY'),
            'mailjet_api_key' => env('MAILJET_APIKEY'),
            'mailjet_api_secret' => env('MAILJET_APISECRET')
        ]
    ],
    'options' => [
        'default_email_service' => env('DEFAULT_EMAIL_SERVICE'),
        'fallback_email_service' => env('FALLBACK_EMAIL_SERVICE')
    ],
    'email_options' => [
        'mail_from_address' => env('MAIL_FROM_ADDRESS'),
        'mail_from_name' => env('MAIL_FROM_NAME')
    ]
];
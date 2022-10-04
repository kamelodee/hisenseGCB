<?php

use Monolog\Formatter\LineFormatter;
use ProgLib\Sms\Foundation\Transports\BeelineTransport;
use ProgLib\Sms\Foundation\Transports\LogTransport;
use ProgLib\Sms\Foundation\Transports\SmppTransport;

return [

    /*
    |--------------------------------------------------------------------------
    | SMS Settings
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'default' => env('SMS_TRANSPORT', 'log'),

    'settings' => [

        'log' => [
            'transport' => LogTransport::class,
            'sender' => env('SMS_SENDER', '')
        ],

        'smpp' => [
            'transport' => SmppTransport::class,
            'timeout' => env('SMS_TIMEOUT', 90),
            'host' => env('SMS_HOST', '127.0.0.1'),
            'port' => env('SMS_PORT', 2775),
            'username' => env('SMS_USERNAME', ''),
            'password' => env('SMS_PASSWORD', ''),
            'sender' => env('SMS_SENDER', '')
        ],

        'beeline' => [
            'transport' => BeelineTransport::class,
            'host' => env('SMS_HOST', '127.0.0.1'),
            'username' => env('SMS_USERNAME', ''),
            'password' => env('SMS_PASSWORD', ''),
            'sender' => env('SMS_SENDER', '')
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | SMS Logging
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'logging' => [

        'channel' => env('SMS_LOG_CHANNEL', 'sms'),

        'settings' => [
            'driver' => 'daily',
            'path' => storage_path('logs/sms/sms.log'),
            'formatter' => LineFormatter::class,
            'formatter_with' => [
                'format' => '[%datetime%] sms.%level_name%: %message%' . PHP_EOL,
                'dateFormat' => 'Y-m-d H:i:s',
                'allowInlineLineBreaks' => true
            ],
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => env('LOG_DAYS', 30)
        ]
    ]
];
<?php
return [

    'use' => 'production',

    'properties' => [

        'production' => [
            'host'           => env('AMQP_HOST', 'localhost'),
            'port'           => env('AMQP_PORT', 5672),
            'username'       => env('AMQP_USERNAME', 'guest'),
            'password'       => env('AMQP_PASSWORD', 'guest'),
            'vhost'          => env('AMQP_VHOST', '/'),
            'exchange'       => env('AMQP_EXCHANGE', 'test'),
            'exchange_type'  => env('AMQP_EXCHANGE_TYPE', 'direct'),
        ],

    ],

];

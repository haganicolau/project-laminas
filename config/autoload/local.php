<?php

return [
    'db' => [
        'adapters' => [
            'apigility' => [
                'charset' => getenv('MYSQL_CHARSET'),
                'dbname' => getenv('MYSQL_DATABASE'),
                'driver' => getenv('CONFIG_DRIVER'),
                'host' => getenv('MYSQL_HOST'),
                'user' => getenv('MYSQL_USER'),
                'password' => getenv('MYSQL_ROOT_PASSWORD'),
                'port' => getenv('MYSQL_PORT'),
                'route' => getenv('CONFIG_ROUTE'),
                'adapter' => getenv('CONFIG_ADAPTER'),
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authentication' => [
            'adapters' => [
                'apigility' => [
                    'adapter' => getenv('CONFIG_MYSQL_ADAPTER'),
                    'storage' => [
                        'adapter' => getenv('CONFIG_ADAPTER'),
                        'dsn' => getenv("MYSQL_DNS"),
                        'route' => getenv('CONFIG_ROUTE'),
                        'username' => getenv('MYSQL_USER'),
                        'password' => getenv('MYSQL_ROOT_PASSWORD'),
                    ],
                ],
            ],
        ],
    ],
];
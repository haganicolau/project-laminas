<?php

/**
 * This file was autogenerated by laminas-api-tools/api-tools-mvc-auth (bin/api-tools-mvc-auth-oauth2-override.php),
 * and overrides the Laminas\ApiTools\OAuth2\Service\OAuth2Server to provide the ability to create named
 * OAuth2\Server instances.
 */
return [
    'service_manager' => [
        'factories' => [
            \Laminas\ApiTools\OAuth2\Service\OAuth2Server::class
                => \Laminas\ApiTools\MvcAuth\Factory\NamedOAuth2ServerFactory::class,
        ],
    ],
];

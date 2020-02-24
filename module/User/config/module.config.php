<?php
return [
    'service_manager' => [
        'factories' => [
            \User\V1\Rest\Users\UsersResource::class => \User\V1\Rest\Users\UsersResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'user.rest.users' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/users[/:users_id]',
                    'defaults' => [
                        'controller' => 'User\\V1\\Rest\\Users\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'user.rest.users',
        ],
    ],
    'api-tools-rest' => [
        'User\\V1\\Rest\\Users\\Controller' => [
            'listener' => \User\V1\Rest\Users\UsersResource::class,
            'route_name' => 'user.rest.users',
            'route_identifier_name' => 'users_id',
            'collection_name' => 'users',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \User\Entity\User::class,
            'collection_class' => \User\V1\Rest\Users\UsersCollection::class,
            'service_name' => 'Users',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'User\\V1\\Rest\\Users\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'User\\V1\\Rest\\Users\\Controller' => [
                0 => 'application/vnd.user.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'User\\V1\\Rest\\Users\\Controller' => [
                0 => 'application/vnd.user.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \User\Entity\User::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'user.rest.users',
                'route_identifier_name' => 'users_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \User\V1\Rest\Users\UsersCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'user.rest.users',
                'route_identifier_name' => 'users_id',
                'is_collection' => true,
            ],
        ],
    ],
];

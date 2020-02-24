<?php

namespace Library\ACL;

use Library\ACL\Role;

/**
 * Classe que mantém os recursos e regras de uso dos recursos
 *
 * @author Hagamenon <haganicolau@gmail.com>
 * @date 19/07/2019
 */
class Resource {
    private $resources = [];
    
    
    /**
     * Encapsula o processo de explode do file path do recurso a ser usado
     * @param string $resource
     * 
     * @return string
     */
    public static function getFilePath(string $resource) {
        //var_dump($resource);exit;
        $filePath = explode("::", $resource);
        return $filePath[0];
    }
    
    /**
     * Retorna a lista de todos os recursos do sitema
     *
     * @return array
     */
    public static function getResources()
    {
        return [
            'User\V1\Rest\User\Controller',
            'Status\V1\Rest\Status\Controller',
            'Laminas\ApiTools\OAuth2\Controller\Auth::token',
            'Product\V1\Rest\Products\Controller'
        ];
    }
    
    /**
     * Retorna a lista de recursos que não precisam de autenticação
     *
     * @return object
     */
    public static function getFreeResources()
    {
        return [
            (object) ['resource' => 'User\V1\Rest\Users\Controller','method' => 'POST'],
            (object) ['resource' => 'User\V1\Rest\ChangePassword\Controller','method' => 'POST'],
            (object) ['resource' => 'User\V1\Rest\RecoveryPassword\Controller','method' => 'POST']
        ];
    }
    
    /**
     * Retorna cada recursos como chave e sua lista de regras e permissões
     
     * @return array
     */
    public static function getRulesResources()
    {
        return [
            'Laminas\ApiTools\OAuth2\Controller\Auth::token' =>
            [
                'guest' => ['POST']
            ],
            'User\V1\Rest\User\Controller' =>
            [
                Role::GUEST => [
                    'POST'
                ],
                Role::ADMIN => [
                    'GET', 'POST', 'DELETE', 'PUT'
                ], 
                Role::AGR => [
                    'GET', 'POST', 'PUT'
                ], Role::USER => [
                    'GET, POST', 'PUT',
                ]
            ],
            
            'Status\V1\Rest\Status\Controller' => 
            [
                Role::ADMIN => [
                    'GET', 'POST', 'DELETE', 'PUT'
                ],
                Role::USER => [
                    'GET'
                ]
            ],
            
            'Product\V1\Rest\Products\Controller' => 
            [
                Role::ADMIN => [
                    'GET', 'POST', 'DELETE', 'PUT'
                ],
                Role::USER => [
                    'GET', 'POST'
                ]
            ]
        ];
    }
    
    /**
     * Definindo recursos que serão liberados para guest, responsável pelo painel
     * administrativo do apigility.
     
     * @return array
     */
    public static function getRulesResourcesAllow()
    {
        return [
            'Application\Controller\IndexController::index',
            'Laminas\ApiTools\Admin\Controller\App::app',
            'Laminas\ApiTools\Admin\Controller\Dashboard::dashboard',
            'Laminas\ApiTools\Admin\Controller\RestService::collection',
            'Laminas\ApiTools\Admin\Controller\RpcService::collection',
            'Laminas\ApiTools\Admin\Controller\Hydrators::hydrators',
            'Laminas\ApiTools\Admin\Controller\DbAdapter::collection',
            'Laminas\ApiTools\Admin\Controller\DoctrineAdapter::collection',
            'Laminas\ApiTools\Admin\Controller\RestService::entity',
            'Laminas\ApiTools\Admin\Controller\Authorization::authorization',
            'Laminas\ApiTools\Admin\Controller\Source::source',
            'Laminas\ApiTools\Admin\Controller\ContentNegotiation::collection',
            'Laminas\ApiTools\Admin\Controller\Authentication::authentication',
            'Laminas\ApiTools\Admin\Controller\Authentication::mapping',
            'Laminas\ApiTools\Admin\Controller\AuthenticationType::authType',
            'Laminas\ApiTools\Documentation\Controller::show',
            'Laminas\ApiTools\Admin\Controller\ApigilityVersionController::index',
            'Laminas\ApiTools\Admin\Controller\Module::collection'
        ];
    }
}

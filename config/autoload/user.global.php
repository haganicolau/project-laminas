<?php

/**
 * @see       https://github.com/laminas-api-tools/api-tools-skeleton for the canonical source repository
 * @copyright https://github.com/laminas-api-tools/api-tools-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas-api-tools/api-tools-skeleton/blob/master/LICENSE.md New BSD License
 */

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

$config = include __DIR__ . '/local.php';

$directory = opendir(__DIR__ . '/../../module/');
$subDirectory = [];
while ($arquivo=readdir($directory)) {
    if($arquivo === '..' || $arquivo === '.')        
        continue;
    array_push($subDirectory, $arquivo);
}

$paths = [];
foreach($subDirectory as $module){
    array_push($paths, __DIR__ . "/../../module/{$module}/src/Entity");
}

$drivers = [];
foreach($subDirectory as $module){
        $drivers["{$module}\\Entity"] = 'Doctrine_driver';
}

$data = [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => $config['db']['adapters']['apigility']['driver'],
                'params' => [
                    'adapter' => $config['db']['adapters']['apigility']['adapter'],
                    'host' => $config['db']['adapters']['apigility']['host'],
                    'dbname' => $config['db']['adapters']['apigility']['dbname'],
                    'route' => $config['db']['adapters']['apigility']['route'],
                    'user' => $config['db']['adapters']['apigility']['user'],
                    'password' => $config['db']['adapters']['apigility']['password'],
                    'charset' => $config['db']['adapters']['apigility']['charset'],
                    'port' => $config['db']['adapters']['apigility']['port']
                ],
            ],
        ],
        'driver' => [
            'Doctrine_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    $paths
                ],
            ],
            'orm_default' => [
                'drivers' => $drivers
            ],
        ],
    ],
];

return $data;
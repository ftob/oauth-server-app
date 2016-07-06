<?php

$loader->load(__DIR__ . '/security.php');
$loader->load(__DIR__ . '/services.php');
$loader->load(__DIR__ . '/parameters.php');


/** @var \Symfony\Component\DependencyInjection\ContainerBuilder $container */
$container->setParameter('locale', 'en');

$container->loadFromExtension(
    'framework',
    [
        'secret' => '%secret%',
        'router' => [
            'resource' => '%kernel.root_dir%/Resources/config/common/routing.php',
        ],
        'session' => [
            'handler_id' => 'snc_redis.session.handler'
        ],
        'http_method_override' => true,
        'default_locale' => '%locale%'
    ]
);


$container->loadFromExtension(
    'doctrine', [
        'dbal'	 => [
            'default_connection' => 'default',
            'connections'		 => [
                'default'	 => [
                    'driver'	 => 'pdo_mysql',
                    'host'		 => '%database_host%',
                    'port'		 => '%database_port%',
                    'dbname'	 => '%database_database%',
                    'user'		 => '%database_username%',
                    'password'	 => '%database_password%',
                    'charset'	 => '%database_charset%'
                ],
                'analytics'	 => [
                    'driver'	 => 'pdo_mysql',
                    'host'		 => '%analytics_host%',
                    'port'		 => '%analytics_port%',
                    'dbname'	 => '%analytics_database%',
                    'user'		 => '%analytics_username%',
                    'password'	 => '%analytics_password%',
                    'charset'	 => '%analytics_charset%'
                ]
            ]
        ],
        'orm'	 => [
            'auto_generate_proxy_classes'	 => false,
            'naming_strategy'				 => 'doctrine.orm.naming_strategy.underscore',
            'auto_mapping'					 => true,
            # enable metadata caching
            'metadata_cache_driver'			 => 'redis',
            # enable query caching
            'query_cache_driver'			 => 'redis'
        ]
    ]
);
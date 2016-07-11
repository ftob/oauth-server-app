<?php

$loader->load(__DIR__ . '/security.php');
$loader->load(__DIR__ . '/parameters.php');
$loader->load(__DIR__ . '/services.php');


/** @var \Symfony\Component\DependencyInjection\ContainerBuilder $container */
$container->setParameter('locale', 'en');
$container->loadFromExtension(
    'snc_redis',
    [
        'clients' => [
            'default' => [
                'type' => 'predis',
                'alias' => 'default',
                'dsn' => 'redis://redis/0'
            ]
        ],
        'session' => [
            'client' => 'default'
        ],
        # configure doctrine caching
        'doctrine' => [
            'metadata_cache' => [
                'client' => 'default',
                'entity_manager' => ['default'],
                'document_manager' => ['default']
            ],

            'result_cache' => [
                'client' =>  'default',
                'entity_manager' => ['default']
            ],

            'query_cache' => [
                'client' =>  'default',
                'entity_manager' => ['default']
            ]
        ]

    ]
);
$container->loadFromExtension(
    'framework',
    [
        'secret' => '%secret%',
        'router' => [
            'resource' => '%kernel.root_dir%/Resources/config/common/routes.php',
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
                    'driver'	 => 'pdo_pgsql',
                    'host'		 => '%database_host%',
                    'port'		 => '%database_port%',
                    'dbname'	 => '%database_database%',
                    'user'		 => '%database_username%',
                    'password'	 => '%database_password%',
                    'charset'	 => '%database_charset%'
                ]
            ]
        ],
        'orm'	 => [
            'auto_generate_proxy_classes'	 => '%kernel.debug%',
            'naming_strategy'				 => 'doctrine.orm.naming_strategy.underscore',
            'auto_mapping'					 => true,
            # enable metadata caching
            'metadata_cache_driver'			 => 'redis',
            # enable query caching
            'query_cache_driver'			 => 'redis'
        ]
    ]
);

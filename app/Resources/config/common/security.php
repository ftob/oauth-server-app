<?php
$container->loadFromExtension(
    'security',
    [
        'providers' => [
            'in_memory' => [
                'memory' => null
            ],
        ],

        'firewalls' => [
            'dev' => [
                'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
                'security' => false
            ],
            'main' => [
                'anonymous' => null
            ]
        ],
    ]
);

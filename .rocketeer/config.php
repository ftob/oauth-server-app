<?php
return [

        'connections' => [
            'production' => [
                'host'      => getenv('DEPLOY_PRODUCTION_SERVER'),
                'username'  => getenv('DEPLOY_PRODUCTION_USERNAME'),
                'key'       => '/root/.ssh/id_rsa',
                'keyphrase' => '',
            ],
            'staging' => [
                'host'      => getenv('DEPLOY_STAGING_SERVER'),
                'username'  => getenv('DEPLOY_STAGING_USERNAME'),
                'key'       => '/root/.ssh/id_rsa',
                'keyphrase' => '',
            ],
    ]
];
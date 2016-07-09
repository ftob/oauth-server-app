<?php
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

$container->setDefinition('repository.client', new Definition(\Ftob\OauthServerApp\Repositories\ClientRepository::class))
    ->setFactory([new Reference('doctrine.orm.entity_manager'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\Client::class]);

$container->setDefinition('repository.access_token', new Definition(\Ftob\OauthServerApp\Repositories\AccessTokenRepository::class))
    ->setFactory([new Reference('doctrine'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\AccessToken::class]);

$container->setDefinition('repository.auth_code', new Definition(\Ftob\OauthServerApp\Repositories\AuthCodeRepository::class, []))
    ->setFactory([new Reference('doctrine.orm.entity_manager'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\AuthCode::class]);

$container->setDefinition('repository.refresh_token', new Definition(\Ftob\OauthServerApp\Repositories\RefreshTokenRepository::class, []))
    ->setFactory([new Reference('doctrine.orm.entity_manager'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\RefreshToken::class]);

$container->setDefinition('repository.scope', new Definition(\Ftob\OauthServerApp\Repositories\ScopeRepository::class, []))
    ->setFactory([new Reference('doctrine.orm.entity_manager'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\Scope::class]);

$container->setDefinition('repository.user', new Definition(\Ftob\OauthServerApp\Repositories\UserRepository::class, []))
    ->setFactory([new Reference('doctrine.orm.entity_manager'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\User::class]);

$container->setDefinition('service.server', new Definition(\League\OAuth2\Server\AuthorizationServer::class, [
        new Reference('repository.client'),
        new Reference('repository.access_token'),
        new Reference('repository.scope'),
        '%path_private_key%',
        '%path_public_key%',
    ])
);


$container->setDefinition('date.interval', new Definition(\DateInterval::class, ['PT1H']));

// Client credentials grant
$container->setDefinition('grant.ccg', new Definition(\League\OAuth2\Server\Grant\ClientCredentialsGrant::class, [
    new Reference('date.interval')
]));

$container->setDefinition(
    'service.server.ccg',
    new Definition(\Ftob\OauthServerApp\Services\ServerService::class, [
            new Reference('service.server'),
            new Reference('grant.ccg')
        ]
    ));


$container->setDefinition('grant.ig', new Definition(\League\OAuth2\Server\Grant\ImplicitGrant::class, [
    new Reference('date.interval')
]));


$container->setDefinition(
    'service.server.ig',
    new Definition(\Ftob\OauthServerApp\Services\ServerService::class, [
            new Reference('service.server'),
            new Reference('grant.ig')
        ]
    ));
<?php
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

$container->setDefinition('repository.client', new Definition(\Doctrine\ORM\EntityRepository::class, []))
    ->setFactory([new Reference('octrine.orm.entity_manager'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\Client::class]);

$container->setDefinition('repository.access_token', new Definition(\Doctrine\ORM\EntityRepository::class, []))
    ->setFactory([new Reference('octrine.orm.entity_manager'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\AccessToken::class]);

$container->setDefinition('repository.auth_code', new Definition(\Doctrine\ORM\EntityRepository::class, []))
    ->setFactory([new Reference('octrine.orm.entity_manager'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\AuthCode::class]);

$container->setDefinition('repository.refresh_token', new Definition(\Doctrine\ORM\EntityRepository::class, []))
    ->setFactory([new Reference('octrine.orm.entity_manager'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\RefreshToken::class]);

$container->setDefinition('repository.scope', new Definition(\Doctrine\ORM\EntityRepository::class, []))
    ->setFactory([new Reference('octrine.orm.entity_manager'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\Scope::class]);

$container->setDefinition('repository.user', new Definition(\Doctrine\ORM\EntityRepository::class, []))
    ->setFactory([new Reference('octrine.orm.entity_manager'), 'getRepository'])
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
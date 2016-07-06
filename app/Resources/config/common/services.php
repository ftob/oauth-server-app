<?php
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

$container->setDefinition('repository.client', new Definition(\Doctrine\ORM\EntityRepository::class, []))
    ->setFactory([new Reference('octrine.orm.entity_manager'), 'getRepository'])
    ->setArguments([\Ftob\OauthServerApp\Entity\Client::class]);
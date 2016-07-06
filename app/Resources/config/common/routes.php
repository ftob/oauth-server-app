<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
$collection->add('index', new Route('/', [
    '_controller' => 'AppBundle:Index:index',
]));

$collection->add('access_token', new Route('/api/v1/auth/access_token', [
    '_controller' => 'AppBundle:AccessToken:index', [], [], '', [], ['GET']
]));


$collection->add('authorize', new Route('/api/v1/auth/authorize', [
    '_controller' => 'AppBundle:Authorize:index',
]), [], [], '', [], ['POST']);

return $collection;
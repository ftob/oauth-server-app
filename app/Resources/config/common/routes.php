<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
$collection->add('_index', new Route('/', [
    '_controller' => '',
]));

$collection->add('_', new Route('/api/v1/auth/access_token', [
    '_controller' => '',
]));

return $collection;
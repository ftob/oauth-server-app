<?php
/**
 * Symfony 3 front controller
 */

use Symfony\Component\HttpFoundation\Request;

/**
 * @var Composer\Autoload\ClassLoader
 */
$loader = require __DIR__.'/../../app/bootstrap.php';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();  
$kernel = new AppCache($kernel);

Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

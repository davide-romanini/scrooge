<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';
if (!getenv('SYMFONY_ENV')) {
    $dotenv = new Dotenv();
    $dotenv->load(__DIR__.'/../app/config/.env');
}

$debug = getenv('SYMFONY_DEBUG');

if ($debug) {
    Debug::enable();
} else {
    include_once __DIR__.'/../var/bootstrap.php.cache';
}

$kernel = new AppKernel(getenv('SYMFONY_ENV'), $debug);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

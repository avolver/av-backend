<?php
declare(strict_types = 1);

use Av\Common\Kernel;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../lib/autoload.php';

$env   = getenv('APP_ENV') ?: ($_SERVER['APP_ENV'] ?? 'dev');
$debug = (bool) (getenv('APP_DEBUG') ?: 'dev' === ($_ENV['APP_ENV'] ?? 'dev'));

if ($debug) {
    umask(0000);

    Debug::enable();
}

$kernel    = new Kernel($env, $debug);
$request   = Request::createFromGlobals();
$response  = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

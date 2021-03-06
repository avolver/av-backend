<?php
/**
 * The software is called "Auto-Volunteers" and is a volunteer coordination system.
 * Copyright (C) 2019 Vladimir Tkachev
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

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

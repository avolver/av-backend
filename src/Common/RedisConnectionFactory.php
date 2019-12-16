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

namespace Av\Common;

use Predis\Connection\PhpiredisSocketConnection;
use Predis\Connection\PhpiredisStreamConnection;
use Snc\RedisBundle\Client\Predis\Connection\ConnectionFactory as BaseConnectionFactory;

/**
 * Redis connection factory, indicating to work through the phpiredis extension.
 *
 * Implemented for greater performance.
 */
final class RedisConnectionFactory extends BaseConnectionFactory
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->schemes = [
            'tcp'  => PhpiredisStreamConnection::class,
            'unix' => PhpiredisSocketConnection::class
        ];
    }
}

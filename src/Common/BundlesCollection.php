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

use Av\Common\Traits\PrivateConstructorTrait;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle;
use Snc\RedisBundle\SncRedisBundle;
use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MakerBundle\MakerBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;

/**
 * Набор необходимых бандлов
 */
final class BundlesCollection
{
    use PrivateConstructorTrait;

    private const BUNDLES_GENERIC = [
        FrameworkBundle::class,
        DoctrineBundle::class,
        DoctrineMigrationsBundle::class,
        SncRedisBundle::class,
        MonologBundle::class
    ];

    private const BUNDLES_DEV = [
        DebugBundle::class,
        MakerBundle::class,
        DoctrineFixturesBundle::class
    ];

    /**
     * Получить все классы бандлов.
     *
     * @param string $env
     *
     * @return \Generator
     */
    public static function getBundles(string $env): \Generator
    {
        yield from self::yieldBundles(self::BUNDLES_GENERIC);

        if ('dev' === $env) {
            yield from self::yieldBundles(self::BUNDLES_DEV);
        }
    }

    /**
     * Создаёт объекты из массива с FCQN и йелдит их.
     *
     * @param array $fcqns
     *
     * @return \Generator
     */
    private static function yieldBundles(array $fcqns): \Generator
    {
        foreach ($fcqns as $fcqn) {
            yield new $fcqn();
        }
    }
}

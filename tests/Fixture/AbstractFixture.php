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

namespace Av\Tests\Fixture;

use Doctrine\Bundle\FixturesBundle\Fixture as BaseFixture;

/**
 * Abstract fixture.
 */
abstract class AbstractFixture extends BaseFixture
{
    /**
     * Create reference link name.
     *
     * @param object|string $name
     * @param int           $id
     *
     * @return string
     */
    public static function createRefName($name, int $id): string
    {
        return \sprintf('%s__%d', \is_object($name) ? \get_class($name) : $name, $id);
    }

    /**
     * Save entity reference.
     *
     * @param object $object
     * @param int    $id
     */
    protected function saveRef(object $object, int $id): void
    {
        $this->setReference(self::createRefName($object, $id), $object);
    }

    /**
     * Load entity reference.
     *
     * @param string $name
     * @param int    $id
     *
     * @return mixed
     */
    protected function loadRef(string $name, int $id)
    {
        return $this->getReference(self::createRefName($name, $id));
    }
}

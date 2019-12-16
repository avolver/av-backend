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

use Av\Domain\Entity\Clinic;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 * Clinic fixture.
 */
final class ClinicFixture extends AbstractFixture
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('ru_RU');

        // Create clinics
        $baseClinic = new Clinic();
        for ($count = 1; $count <= 5; $count++) {
            $clinic = (clone $baseClinic)
                ->setName('Больница №' . $count)
                ->setAddress($faker->address);

            $this->saveRef($this, $count);
            $manager->persist($clinic);
        }

        $manager->flush();
    }
}
